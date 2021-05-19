<?php
/**
 * File name: UserAPIController.php
 * Last modified: 2020.06.07 at 07:02:57
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Http\Controllers\API\Driver;

use App\Events\UserRoleChangedEvent;
use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Earning;
use App\Models\User;
use App\Models\Postion;
use App\Models\Tripe;
use App\Repositories\CustomFieldRepository;
use Illuminate\Support\Str;
use App\Repositories\DriverRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UploadRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Prettus\Validator\Exceptions\ValidatorException;

class UserAPIController extends Controller
{
    private $userRepository;
    private $uploadRepository;
    private $roleRepository;
    private $customFieldRepository;
    private $driverRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(UserRepository $userRepository, DriverRepository $driverRepository, UploadRepository $uploadRepository, RoleRepository $roleRepository, CustomFieldRepository $customFieldRepo)
    {
        $this->userRepository = $userRepository;
        $this->uploadRepository = $uploadRepository;
        $this->roleRepository = $roleRepository;
        $this->customFieldRepository = $customFieldRepo;
        $this->driverRepository = $driverRepository;
    }

    function login(Request $request)
    {
        try {
            $this->validate($request, [
                'phone' => 'required',
                'password' => 'required'
            ]);

            if (auth()->attempt(['phone' => $request->phone, 'password' => $request->password])) {
                // Authentication passed...
                $user = User::find(auth()->user()->id);
                $driver = User::find(auth()->user()->id)->driver;
                
                if ($driver == null) {
                   return $this->sendError('User not driver', 401);
                }
                
                $user->device_token = $request->input('device_token');
                $user->save();
                $info = [$user,$driver];
                return $this->sendResponse($info, 'User retrieved successfully');
            }
            else{
             return $this->sendError('No User Has Been Found', 404);   
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 401);
        }

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return
     */

    function register(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'phone'=>'required|unique:users',
                'password' => 'required',
            ]);
            $user = new User;
            $user->name = $request->input('name');
            $user->phone = $request->input('phone');
            $user->device_token = $request->input('device_token');
            $user->password = bcrypt($request->input('password'));
            $user->api_token = str_random(60);
            $user->is_verified = 0;
            $user->gender =  $request->input('gender');
            $user->save();
            $user->assignRole('driver');
            event(new UserRoleChangedEvent($user));
            $id = $user->id;
            $eran = new Earning;
            $eran->id = $id;
            $eran->save();
        }
        catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 401);
        }
        return $this->sendResponse($user, 'User retrieved successfully');
    }

    function logout(Request $request)
    {
        $user = $this->userRepository->findByField('api_token', $request->input('api_token'))->first();
        if (!$user) {
            return $this->sendError('User not found', 401);
        }
        try {
            auth()->logout();
        } catch (\Exception $e) {
            $this->sendError($e->getMessage(), 401);
        }
        return $this->sendResponse($user['name'], 'User logout successfully');

    }

    function user(Request $request)
    {
        $user = $this->userRepository->findByField('api_token', $request->input('api_token'))->first();

        if (!$user) {
            return $this->sendError('User not found', 401);
        }
        return $this->sendResponse($user, 'User retrieved successfully');
    }

     function check_car(Request $request){
    
    $user = $this->userRepository->where('api_token','=',$request->api_token)->get();
    
    $car = $user[0]->car;
    if($car == null ){
        return $this->sendError('Must Enetr Car', 401);
    }
     return $this->sendResponse(true, 'car retrieved successfully');
        
    }

    function settings(Request $request)
    {
        $settings = setting()->all();
        $settings = array_intersect_key($settings,
            [
                'default_tax' => '',
                'default_currency' => '',
                'default_currency_decimal_digits' => '',
                'app_name' => '',
                'currency_right' => '',
                'enable_paypal' => '',
                'enable_stripe' => '',
                'enable_razorpay' => '',
                'main_color' => '',
                'main_dark_color' => '',
                'second_color' => '',
                'second_dark_color' => '',
                'accent_color' => '',
                'accent_dark_color' => '',
                'scaffold_dark_color' => '',
                'scaffold_color' => '',
                'google_maps_key' => '',
                'mobile_language' => '',
                'app_version' => '',
                'enable_version' => '',
                'distance_unit' => '',
            ]
        );

        if (!$settings) {
            return $this->sendError('Settings not found', 401);
        }

        return $this->sendResponse($settings, 'Settings retrieved successfully');
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param Request $request
     *
     */
    
    function update($id, Request $request)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            return $this->sendResponse([
                'error' => true,
                'code' => 404,
            ], 'User not found');
        }
        $input = $request->except(['password', 'api_token']);
        try {
            if ($request->has('device_token')) {
                $user = $this->userRepository->update($request->only('device_token'), $id);
            } else {
                $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->userRepository->model());
                $user = $this->userRepository->update($input, $id);

                foreach (getCustomFieldsValues($customFields, $request) as $value) {
                    $user->customFieldsValues()
                        ->updateOrCreate(['custom_field_id' => $value['custom_field_id']], $value);
                }
            }
        } catch (ValidatorException $e) {
            return $this->sendError($e->getMessage(), 401);
        }
        return $this->sendResponse($user, __('lang.updated_successfully', ['operator' => __('lang.user')]));
    }

    function rest_password(Request $request)
    {
        $this->validate($request, ['api_token' => 'required',
                                    'password_old'=>'required',
                                    'password_new'=>'required|min:6']);
        $user = $this->userRepository->findByField('api_token', $request->input('api_token'))->first();
        if (Hash::check($request->password_old, $user->password) == $user->password) {
            $user->password = Hash::make($request->input('password_new'));
            $user->save();
            return $this->sendResponse($user, 'Reset link was sent successfully');
        } 
        else {
             return $this->sendError('Password Is Not Correct', 403);
        }
    }

    function available($id,Request $request)
    {

        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            return $this->sendResponse([
                'error' => true,
                'code' => 404,
            ], 'User not found');
        }
        try {
            if ($request->has('api_token')) {
                
                $user->driver->available = $request->available;
                
                $user->driver->save();
            }
            else {
                $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->userRepository->model());
                $user = $this->driverRepository->update($input, $id);
            }
        } catch (ValidatorException $e) {
            return $this->sendError($e->getMessage(), 401);
        }

        return $this->sendResponse($user, __('lang.updated_successfully', ['operator' => __('lang.user')]));
    }

    function Inbound(Request $request)
    {

        $user = $this->userRepository->findWithoutFail($request->id);

        if (empty($user)) {
            return $this->sendResponse([
                'error' => true,
                'code' => 404,
            ], 'User not found');
        }
        try {
               
                $user->driver->In_bound = $request->In_bound;
                $user->driver->save();
            
        } catch (ValidatorException $e) {
            return $this->sendError($e->getMessage(), 401);
        }

        return $this->sendResponse($user, __('lang.updated_successfully', ['operator' => __('lang.user')]));
    }

    function verify_paper(Request $request)
    {
        $user = $this->userRepository->findByField('api_token', $request->input('api_token'))->first();
        if (empty($user)) {
                    return $this->sendResponse([
                        'error' => true,
                        'code' => 404,
                    ], 'User not found');
                }
        if($user){
           $url_img_id =  $request->img_url_id;
           $url_img_car =  $request->img_url_car;
           $user->driver->img_url_id = $url_img_id;
           $user->driver->img_url_car = $url_img_car;
           $user->driver->save();
           $var = array('url_img_id'=>$url_img_id,'img_url_car'=>$url_img_car);
            return $this->sendResponse($var, 'token retrieved successfull');
        }
    }
    
    function get_paper($id)
    {
        $user = $this->userRepository->findWithoutFail($id);
        if (empty($user)) {
                    return $this->sendResponse([
                        'error' => true,
                        'code' => 404,
                    ], 'User not found');
                }
        
    } 
    
    function getalltripe(Request $request)
    {
        $this->validate($request, ['api_token' => 'required',]);
        
        $user = $this->userRepository->findByField('api_token',$request->api_token)->first();
        
        $earn_data = Earning::find($user->id);
        
        $earn = array('total_trips'=>$earn_data->total_trips,'driver_earning'=>$earn_data->driver_earning);
        
        $tripes_user_data = DB::table('tripes')
        ->join('users','tripes.driver_id','=','users.id')
        ->select('users.name','users.img_url','tripes.*')
        ->where('users.api_token','=',$request->api_token)
        ->get();
        
        $data = array('earn'=>$earn,'tripe'=>$tripes_user_data);
        
        if($data == null )
        {
               return $this->sendResponse(0,'No Tripe Has Been Found');
        }
        
        return $this->sendResponse($data, 'Tripes retrieved successfull');
         
    }
    
}
