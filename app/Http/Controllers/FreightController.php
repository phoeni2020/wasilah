<?php


namespace App\Http\Controllers;
use App\DataTables\FieldDataTable;
use App\DataTables\FreightDataTable;
use App\Models\Driver;
use App\Models\Freight;
use App\Models\User;
use App\DataTables\CarDateTable;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;





class FreightController extends Controller
{
    public function index(FreightDataTable $freightDataTable){
        return $freightDataTable->render('freight.index');
    }
    public function show($id){
        $freight = Freight::find($id);
        return view('freight.show');
    }
    public function GetByStatus($status){
        $code = ['pending'=>0,'placed'=>1,'packed'=>2,'shipped'=>3,'delivered'=>4];
        $status_code = array_key_exists($status,$code) ? $code[$status] : 404;
        if($status_code !== 404){
            $freightDataTable = new FreightDataTable($status_code);
            return $freightDataTable->render('freight.index');

        }
        return redirect(url('/freight'))->with(['massage'=>'Invalid Status Given']);
    }
    public function edit(Freight $id){
        $data = $id;
        $drivers = User::all();
        $driver_arr = [];
        foreach ($drivers as $driver){
            if (!empty($driver->driver()->get()->toArray())){
                $driver_arr[] = $driver;
            }
        }
        $data = [$data,$data->user()->get(),];
        $code =  ['pending'=>0,'placed'=>1,'packed'=>2,'shipped'=>3,'delivered'=>4];
        return view('freight.show',['data'=>$data,'code'=>$code,'driver_arr'=>$driver_arr]);
    }
    public function update(Request $request,Freight $id){
        $massage = $this->massage();
        $rules = $this->rules();
        $validtion = Validator::make($request->all(),$rules,$massage);
        if($validtion->fails()){
            return redirect()->back()->withInput($request->all())->withErrors($validtion->errors());
        }
        if($id->toArray()){
            $id->update($request->all());
        }
        return redirect()->back()->withInput($request->all())->with(['done'=>'Freight Order Updated Successfully']);
    }

    private function massage(){
        return
        [
            'freight_details.required'=>'Freight Details Is Required',
            'status.required'=>'Status Is Required',
            'status.alpha_num'=>'Status Value Should Be A Alpha Numeric Value',
            'user_id.required'=>'User name & user id Is Required',
            'user_id.exists'=>'This User Is Not Found',
            'phone.required'=>'Phone NO Is Required',
            'address.required'=>'User Address Is Required',
            'longitude.required'=>'The Longitude Of Location Is Required',
            'latitude.required'=>'The Latitude Of Location Is Required',
            'driver_id.required'=>'The Driver Name & Driver id Is Required',
        ];
    }

    private function rules(){
        return
            [
                'freight_details'=>'required',
                'status'=>'required|alpha_num',
                'user_id'=>'required|exists:users,id|alpha_num',
                'phone'=>'required|alpha_num|max:15',
                'address'=>'required',
                'longitude'=>'required|alpha_num',
                'latitude'=>'required|alpha_num',
                'driver_id'=>'required|exists:users,id|alpha_num',
            ];
    }
}