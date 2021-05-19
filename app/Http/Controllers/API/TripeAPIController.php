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
use App\Models\Tripe;
use App\Models\Postion;
use App\Repositories\CustomFieldRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UploadRepository;
use App\Repositories\UserRepository;
use App\Repositories\TripRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use Prettus\Validator\Exceptions\ValidatorException;

class TripeAPIController extends Controller
{
    private $userRepository;
    private $tripRepository;
    private $uploadRepository;
    private $roleRepository;
    private $customFieldRepository;
    private $fci_key;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TripRepository $tripRepository,UserRepository $userRepository, UploadRepository $uploadRepository, RoleRepository $roleRepository, CustomFieldRepository $customFieldRepo)
    {
        $this->userRepository = $userRepository;
        $this->tripRepository = $tripRepository;
        $this->uploadRepository = $uploadRepository;
        $this->roleRepository = $roleRepository;
        $this->customFieldRepository = $customFieldRepo;
        $this->fci_key = 'AAAAi3azM_s:APA91bFlUDFzgzkItmM7JezRafuKeOVXEjc5Y5-ss68FhWCgdciH5mVIVeb0VQZyfhsfTpaXtGcVfTRoMzbK1_knjGxAX-M9yq6M3hzoTkODt59dByRCL4UkwBB94Hjj5SB5OVKQ7vpE';
    }

    /**
     * Create a new tripe instance after a valid registration.
     *
     * @param array $data
     * @return
     */

    function register(Request $request)
    {
        $arr = json_decode($request->getContent(),true);
        $data = $arr['client']['drivers'];
        try
        {
            //Asign client name to var to make reusable any where in the context 
            $client = $arr['client']['name'];
            
            //Asign tripe cost to var to make reusable any where in the context 
            $cost = $arr['client']['cost'];
            
            //make new object of the tripe modle and prepare to make new db table row 
            $tripe = new Tripe;
            
            //tripe proprty of user_id get the value from client array index of id
            $tripe->user_id = $arr['client']['id'];

            //tripe proprty of startPoint get the value from client array then startPoint array (multi dimnsion array) index of long
            $tripe->start_point_longitude =$arr['client']['startPoint']['long'];
            
            //tripe proprty of start_point_latitude get the value from client array then startPoint array (multi dimnsion array) index of lat
            $tripe->start_point_latitude=$arr['client']['startPoint']['lat'];
            
            $tripe->start_point_address =$arr['client']['startPoint']['address'];
             
            $tripe->End_point_longitude =$arr['client']['endPoint']['long'];
            
            $tripe->End_point_latitude =$arr['client']['endPoint']['lat'];
            
            $tripe->End_point_address =$arr['client']['endPoint']['address'];
            
            $tripe->in_haram = $arr['client']['in_ahram'];
            
            $tripe->status = 0;
            
            $tripe->cost = $cost;
            
            $tripe->save();
            
            $count = count($data);
            
            for($i=0;$i < $count; $i++)
            {
                $km =  getDistanceBetweenPointsNew($data[$i]['lat'],$data[$i]['lng'],$arr['client']['startPoint']['lat'],$arr['client']['startPoint']['long']);
              //  if($km <= 5)
                //{
                    $drivers_to_push[]= array('km'=>$km,'id'=>$data[$i]['id']);
                //}
            }
            
            $driver = min($drivers_to_push);

            $serch = array_search($driver,$drivers_to_push);

            unset($drivers_to_push[$serch]);
            
            $device = User::find($driver['id']);

            $img = $device->img_url;

            if(!empty($device->car->number))
            {
                $plate_no = $device->car->number;
            }
            else
            {
                return $this->sendError('No Car Has Been Found On The System For That User', 404);     
            }
            
            $cache = str_random(40);

            $content = json_encode($drivers_to_push);

            file_put_contents($cache,$content);
            $fields = array(
                'priority'=> 'high',
                'data' =>array(
                    'type'=>'tripe',
                    'id'=>"$tripe->id",
                    'name'=>$client,
                    'start_point'=>array(
                        'start_point_longitude'=>$tripe->start_point_longitude,
                        'start_point_latitude'=>$tripe->start_point_latitude,
                        "address_start"=>$arr['client']['startPoint']['address']
                        ),
                    'end_point'=>array(
                        'End_point_longitude'=>$tripe->End_point_longitude,
                        'End_point_latitude'=>$tripe->End_point_latitude,
                        "address_end"=>$arr['client']['endPoint']['address']
                        ),
                    'in_haram'=>$arr['client']['in_ahram'],
                    'cost'=>$cost,
                    'cache_id'=>"$cache",
                    'driver'=>$driver['id'],
                    'img'=>$img,
                    'plate_no'=>$plate_no,

                ),
                'notification' => [
                'body' => "The client $client has requsetd new tripe with cost of $cost EGP",
                'title' =>'Garden Taxi New Tripe Request',],
            );
            $headers = array(
               'Content-Type: application/json',
               'Authorization: key=' . $this->fci_key,
            );
            $fields['to']= $device->device_token;
            $ch = curl_init();
            curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
            curl_setopt( $ch,CURLOPT_POST, true );
            curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
            curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
            curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode($fields) );
            $res = curl_exec($ch);
            curl_close( $ch );
            //return $this->sendResponse($res, 'fcm msg');
        }
        catch (\Exception $e)
        {
            return $this->sendError($e->getMessage(), 401);
        }
        return $this->sendResponse($tripe, 'User retrieved successfully');
    }
    
    /**
     * Cancel The Tripe Wiche Not Accpted Yet.
     *
     * @param array $data
     * @return
     */
    function usercancel($id)
    {
        try
        {
            //Find A Tripe Not Accepted Status = 0 Mean's That The Tripe Not Accepted
            $data = Tripe::Where('user_id','=',$id)->where('status','=','0')->select('*')->get();
           
            //Convert The Data Object To An Array 
            $tripe = $data->toArray();
            
            //If The Tripe With'n User Id Not Found return 404 
            if(empty($tripe))
            {
                 return $this->sendError('No Tripe has found',404);
            }
            
            //Delete The Tripe From DataBase
            $sts = DB::table('tripes')->Where('user_id','=',$id)->where('status','=','0')->delete();   
            
            //Return Response That Tripe Canceld
            return $this->sendResponse(['result'=>true], 'Tripe Canceld');
        
        } 
        catch (\Exception $e) {
            $this->sendError($e->getMessage(), 404);
        }
        
    }
     /**
     * Cancel The Tripe Even It's Accepted.
     *
     * @param array $data
     * @return
     */
    function userend_tripe($id)
    {
        try
        {
            //Find A Tripe Not Accepted Status = 0 Mean's That The Tripe Not Accepted
            $data = Tripe::Where('user_id','=',$id)->where('status','=','1')->get();
           
            //Convert The Data Object To An Array 
            $tripe = $data->toArray();
            
            //If The Tripe With'n User Id Not Found return 404 
            if(empty($tripe))
            {
                 return $this->sendError('No Tripe has found',404);
            }
            $data[0]->status = 2;
            
            $data[0]->save();
                        //Return Response That Tripe Canceld
            return $this->sendResponse($data, 'User Has Been Ended The Tripe');
        
        } 
        catch (\Exception $e) {
            $this->sendError($e->getMessage(), 404);
        }
        
    }
    function drivercancel($id,$cache_id)
    {
        try {
            $tripe = Tripe::find($id);
            $data = User::find($tripe->user_id);
            $json = file_get_contents($cache_id);
                $arr = json_decode($json,true);
            if(!empty($arr)){
            
            $driver = min($arr);

            $serch = array_search($driver,$arr);

            unset($arr[$serch]);

            $content = json_encode($arr);

            file_put_contents($cache_id,$content);
            
            
            $device = User::find($driver['id']);
            
           
            $fields = array(
                'priority'=> 'high',
                'data' =>array(
                'type'=>'tripe',
                'id'=>"$id",
                'name'=>$data->name,
                'start_point'=>array(
                    'start_point_longitude'=>$tripe->start_point_longitude,
                    'start_point_latitude'=>$tripe->start_point_latitude,
                    "address_start"=>$tripe->start_point_address
                    ),
                'end_point'=>array(
                    'End_point_longitude'=>$tripe->End_point_longitude,
                    'End_point_latitude'=>$tripe->End_point_latitude,
                    "address_end"=>$tripe->End_point_address
                    ),
                'in_haram'=>$tripe->in_haram,
                'cost'=>$tripe->cost,
                'cache_id'=>"$cache_id",
                'driver'=>$device->id,
                ),
                'notification' => [
                'body' => "The client $data->name has requsetd new tripe with cost of $tripe->cost EGP",
                'title' =>'Garden Taxi New Tripe Request',],
            );
            
            define('FIREBASE_API_KEY','AAAAkowAW4g:APA91bEifs_dsM_qTCuenPp5516bqj157pJPJMknXgZWANVXsgIqOVVHKuhX6MVH5uHilYAYsB6EQAWOIvJ7dmZA_rvspEXonJ8dm6fYF6J_tPE4oAEVDXFxJ0EsDyIgRtsxWYdzRx_9');
                $headers = array(
                    'Content-Type: application/json',
                    'Authorization: key=' . $this->fci_key,
                );
                $fields['to']=$device->device_token;
                $ch = curl_init();
                curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
                curl_setopt( $ch,CURLOPT_POST, true );
                curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
                $result = curl_exec($ch);
                curl_close( $ch );
                return $result;
            }
            else{
                unlink($cache_id);
                return $this->sendResponse('No drivers available right now', 'Tripe Canceld');
            }

               
        
            //return $this->sendResponse('No drivers available right now', 'Tripe Canceld');
        }
        catch (\Exception $e) {
            $this->sendError($e->getMessage(), 401);
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
    
    function getdata($id)
    {   
            $tripe = Tripe::Where('driver_id','=',$id)->where('status','=','1')->select('*')->get();
            if (empty($tripe->toArray())) {
            return $this->sendResponse([
                'error' => true,
                'code' => 404,
            ], 'Tripe not found');
            }
            else{
                $arr = $tripe->toArray();
                $arr['client']= ['name'=>User::find($arr[0]['user_id'])->name,'phone'=>User::find($arr[0]['user_id'])->phone];
                $arr['driver']= ['name'=>User::find($arr[0]['driver_id'])->name,'phone'=>User::find($arr[0]['driver_id'])->phone];
                return $this->sendResponse($arr,'Tripe returtend');
            }
    }
    
    function getdatauser($id)
    {   
            //to get tripe data and return back
            $tripe = Tripe::Where('user_id','=',$id)->where('status','=','1')->get();
            if (empty($tripe->toArray())) {
            return $this->sendResponse([
                'error' => true,
                'code' => 404,
            ], 'Tripe not found');
            }
            else{
                $arr = $tripe->toArray();
                $driver = User::find($arr[0]['driver_id']);
                $arr['client']= ['name'=>User::find($arr[0]['user_id'])->name,'phone'=>User::find($arr[0]['user_id'])->phone];
                $arr['driver']= ['name'=>$driver->name,'phone'=>$driver->phone,'img'=>$driver->img_url,'car_plate'=>$driver->driver->car_number];
                return $this->sendResponse($arr,'Tripe returtend ');
            }
    }
    
    function gettripuser($id)
    {   
            //to get tripe data and return back
            $tripe = Tripe::Where('user_id','=',$id)->where('status','=','0')->get();
            
            if (empty($tripe->toArray())) {
            return $this->sendResponse([
                'error' => true,
                'code' => 404,
            ], 'Tripe not found');
            
            }
            else{
                $arr = $tripe->toArray();
                $arr['client']= ['name'=>User::find($arr[0]['user_id'])->name,'phone'=>User::find($arr[0]['user_id'])->phone,'gender'=>User::find($arr[0]['user_id'])->gender];
                if($arr[0]['driver_id'] != 0){
                    $arr['driver']= ['name'=>User::find($arr[0]['driver_id'])->name,'phone'=>User::find($arr[0]['driver_id'])->phone,'gender'=>User::find($arr[0]['driver_id'])->gender];
                    return $this->sendResponse($arr,'Tripe returtend ');
                }
                else{
                    $arr['driver']= ['name'=>'none','phone'=>0];
                    return $this->sendResponse($arr,'Tripe returtend ');
                }
            }
    }
    
    function approve($id , $driverid)
    {
            
            $tripe = Tripe::find($id);
            
            $tripe->driver_id = $driverid;
        
            $tripe->status = 1;
            
            $tripe->save();
            
            if($tripe->user != null){
            
            $token = $tripe->user->device_token;

            $driver =User::find($tripe->driver_id); 
            
            $name = $driver->name;
            
            $phone =  $driver->phone; 
            $fields = array(
                'priority'=> 'high',
                'to'=>"$token",
                'data' => array('type'=>'tripe','phone'=>"$phone","name"=>"$name","id"=>$tripe->user_id),
                'notification' => [
                'body' => ['massage'=>"the driver $name has approved your tripe and he on his way to you"],
                'title' =>'Garden taxi New Tripe Approved',],
            );
            $headers = array
            (
             'Content-Type: application/json',
            'Authorization: key=' . $this->fci_key,
            );
                
                $ch = curl_init();
                curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
                curl_setopt( $ch,CURLOPT_POST, true );
                curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
                $result = curl_exec($ch);
                curl_close( $ch );
            if (empty($tripe)) {
            return $this->sendResponse([
                'error' => true,
                'code' => 404,
            ], 'Tripe not found');
            }
            else{
                return $this->sendResponse($result,'Tripe returtend ');
            }
        
            }
            
           
    }
}
