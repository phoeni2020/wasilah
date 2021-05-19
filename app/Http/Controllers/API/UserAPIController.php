<?php
/**
 * File name: UserAPIController.php
 * Last modified: 2020.05.04 at 09:04:09
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\CustomFieldRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UploadRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class UserAPIController extends Controller
{
    private $userRepository;
    private $uploadRepository;
    private $roleRepository;
    private $customFieldRepository;
    //private $massages;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository, UploadRepository $uploadRepository, RoleRepository $roleRepository, CustomFieldRepository $customFieldRepo)
    {
        $this->userRepository = $userRepository;
        $this->uploadRepository = $uploadRepository;
        $this->roleRepository = $roleRepository;
        $this->customFieldRepository = $customFieldRepo;
       // $this->massages = massages();
        
    }

    function login(Request $request)
    {
        try {
            $this->validate($request, [
                'phone' => 'required',
                'password' => 'required',
            ]);
            if (auth()->attempt(['phone' => $request->input('phone'), 'password' => $request->input('password')])) {
                // Authentication passed...
                $user = auth()->user();
                $user->device_token = $request->input('device_token', '');
                $user->save();
                return $this->sendResponse($user, 'User retrieved successfully');
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
                'phone' => 'required|unique:users',
                'password' => 'required',
            ]);
            $user = new User;
            $user->name = $request->input('name');
            $user->phone = $request->input('phone');
            $user->device_token = $request->input('device_token');
            $user->password = Hash::make($request->input('password'));
            $user->api_token = str_random(60);
            $user->is_verified = 0;
            $user->gender = 'm';// $request->input('gender');
            $user->api_token = str_random(60);
            $user->save();
           /* if (copy(public_path('images/avatar_default.png'), public_path('images/avatar_default_temp.png'))) {
                            $user->addMedia(public_path('images/avatar_default_temp.png'))
                                ->withCustomProperties(['uuid' => bcrypt(str_random())])
                                ->toMediaCollection('avatar');
                        }*/
            $defaultRoles = $this->roleRepository->findByField('default', '1');
            $defaultRoles = $defaultRoles->pluck('name')->toArray();
            $user->assignRole($defaultRoles);


            
            
        } catch (\Exception $e) {
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
                'home_section_1'=> '',
                'home_section_2'=> '',
                'home_section_3'=> '',
                'home_section_4'=> '',
                'home_section_5'=> '',
                'home_section_6'=> '',
                'home_section_7'=> '',
                'home_section_8'=> '',
                'home_section_9'=> '',
                'home_section_10'=> '',
                'home_section_11'=> '',
                'home_section_12'=> '',
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
    function update(Request $request)
    {
        try 
        {
            $massages = $this->massages();
            
            $validator = Validator::make($request->all(), [
                'api_token' => 'required|exists:users|string',
                'data.name'=>'required|string',
                'data.gender'=>'required|string',
                $massages
            ]);
             
            
            if($validator->fails()){
                $error = $validator->errors();
                return $this->sendError($error, 401);
            }
        
            $user = $this->userRepository->where('api_token','=',$request->api_token)->get();
            
            if (empty($user)) {
                return $this->sendResponse([
                    'error' => true,
                    'code' => 404,
                ], 'User not found');
        }
            
            $input = $request->data;
            
            if ($request->has('device_token')) {
                $user = $this->userRepository->update($request->only('device_token'), $request->api_token);}
                
            else {
                $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->userRepository->model());
                $data = $user->toArray();
                $user = $this->userRepository->update($input, $data[0]['id']);

                foreach (getCustomFieldsValues($customFields, $request) as $value) {
                    $user->customFieldsValues()
                        ->updateOrCreate(['custom_field_id' => $value['custom_field_id']], $value);
                }
            }
            
        }
        catch (ValidatorException $e) 
        {
            return $this->sendError($e->getMessage(), 401);
        }
 
        return $this->sendResponse($user,http_response_code(400), __('lang.updated_successfully', ['operator' => __('lang.user')]))->header('Access-Control-Allow-Origin', 'application/json');
    }
    
    function acconut_img(Request $request)
    {
        $user = $this->userRepository->findByField('api_token', $request->input('api_token'))->first();
        if (empty($user)) {
                    return $this->sendResponse([
                        'error' => true,
                        'code' => 404,
                    ], 'User not found');
                }
        if($user){
           $acconut_img =  $request->acconut_img;
           $user->img_url = $acconut_img;
           $user->save();
           $var = array('img_url'=>$acconut_img);
            return $this->sendResponse($var, 'token retrieved successfull');
        }
    }
    function sendResetLinkEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);

        $response = Password::broker()->sendResetLink(
            $request->only('email')
        );

        if ($response == Password::RESET_LINK_SENT) {
            return $this->sendResponse(true, 'Reset link was sent successfully');
        } else {
            return $this->sendError('Reset link not sent', 401);
        }

    }
    function available($id,Request $request)
    {
        $this->validate($request, ['available' => 'required']);
        $user = $this->userRepository->findWithoutFail($id);
        if (empty($user)) {
            return $this->sendResponse([
                'error' => true,
                'code' => 404,
            ], 'User not found');
        }
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
     function getalltripe(Request $request)
    {
        $this->validate($request, ['api_token' => 'required',]);
        
        $data = DB::table('tripes')
        ->join('users','tripes.user_id','=','users.id')
        ->select('users.name','users.img_url','tripes.*')
        ->where('users.api_token','=',$request->api_token)
        ->get();
        
        return $this->sendResponse($data, 'Tripes retrieved successfull');
         
    }
    
    function massages(){
        
        return $massage = [
            'api_token.required' => 'Must Send Api Token',
            'api_token.exists' => 'This Api Token Not exists',
            'api_token.string' => 'Must Send Api Token As String',
            'name.required' =>'Must Send Name',
            'name.string' => 'Must Send Name As String',
            'gender.required' =>'Must Send gender',
            'gender.string'=>'Must Send Gender string '
        ];
        
    }
}
