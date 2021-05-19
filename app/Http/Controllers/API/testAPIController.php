<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Error;


class testAPIController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     private $fci_key;
    function test(){
         $this->fci_key = 'AAAAi3azM_s:APA91bFlUDFzgzkItmM7JezRafuKeOVXEjc5Y5-ss68FhWCgdciH5mVIVeb0VQZyfhsfTpaXtGcVfTRoMzbK1_knjGxAX-M9yq6M3hzoTkODt59dByRCL4UkwBB94Hjj5SB5OVKQ7vpE';
          $fields = array(
                    'priority'=> 'high',
                    'data' =>array(
                    'price'=>"1234",
                    ),
                    'notification' => [
                    'title' =>'Garden Taxi The User Has Ended The Tripe',],
                );
                $headers = array(
                    'Content-Type: application/json',
                    'Authorization: key=' . $this->fci_key,
                );
                $fields['to']='focCqfXtSACDvsFMJfAtQD:APA91bGRDl6_cmkeKMg6LWOqIW_ob_eQDEhBnN-8U5-qHsDb6eRVwcI0q38NZsEdJbMnInC6BEt3HvaBvYQLBGEfrZoyrO_u8nqArW3b0MGLh6chesgWG79TlKbdGeBRio8iuUbaJgir';
                $ch = curl_init();
                curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
                curl_setopt( $ch,CURLOPT_POST, true );
                curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
                $result = curl_exec($ch);
                return $result;
                curl_close( $ch ); 
    }
    function version(){
    $v = DB::table('app_settings')->select('value')->where('key','=','app_version')->get();
     return $this->sendResponse($v,'version returned successfully');
    }
    function version_driver(){
    $v = DB::table('app_settings')->select('value')->where('key','=','driver_app_version')->get();
     return $this->sendResponse($v,'version returned successfully');
    }

    function price_kilo(Request $requset){
        if($requset->dest == '1'){
            $v = DB::table('app_settings')->select('value')->where('key','=','kilo_inbound_price')->get();
            $arr_res = ['kilePrice'=>$v[0]->value,'baseFare'=>0];
            return $this->sendResponse($arr_res,'InBound Price returned successfully');
        }
        else{
        $v = DB::table('app_settings')->select('value')->where('key','=','kilo_outbound_price')->get();
        $arr_res = ['kilePrice'=>$v[0]->value,'baseFare'=>10];
        return $this->sendResponse($arr_res,' Out Bound Price returned successfully');    
        }
        
    }
    
    function error_store(Request $requset){
        $error = new Error();
        
        $error->err_location = $requset->err_location;
        
        $error->err_msg = $requset->err_msg;
        
        $error->err_output = $requset->err_output;
        
        $error->http_status = $requset->http_status;
        
        $error->requset_body = $requset->requset_body;
        
        $error->api_url = $requset->api_url;
        
        $error->err_desc = $requset->err_desc;
        
        $error->save();
        
         return $this->sendResponse($error,'Error Saved');
    }



}