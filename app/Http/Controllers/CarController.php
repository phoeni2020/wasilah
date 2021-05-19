<?php

namespace App\Http\Controllers;

use App\DataTables\CarDateTable;
use App\Models\Car;
use App\Models\User;
use App\Models\Driver;
use App\Repositories\CarRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use Flash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Prettus\Validator\Exceptions\ValidatorException;

class CarController extends Controller
{
    private $carRepository;

    private $massage;

    private $rules;

    public function __construct(CarRepository $carRepo){
        $this->carRepository = $carRepo;
    }

    public function index(CarDateTable $carDataTable){
        //dd(Car::all());
        return $carDataTable->render('car.index');
    }

    public function create(){
        $users = Driver::all();
        $user_data = [];
        foreach ($users as $user){
            $user_data[]= $user;
        }
        return view('car.create',['user_data'=>$user_data]);
    }
    public function store(Request $request){
        //create validtion massages
        $this->massage = $this->massage_vaildtion();
        //create validtion rules
        $this->rules = $this->rules_validtion();
        //Validtion
        $validtor = Validator::make($request->all(),$this->rules,$this->massage);
        //cheack if the validtion passed or not
        if($validtor->fails()){
            //if not passed get the errors massages
            $error  = $validtor->errors();
            //return the error massages with the data the user provid it
            return back()->with()->withErrors($error)->withInput($request);
        }
        //if the validtion passed create new instance form car
        $car = new Car();

        //$res = $car->create($request->all());
        $car->Type = $request->Type;
        $car->brand = $request->brand;
        $car->color = $request->color;
        $car->number = $request->number;
        $car->capacity = $request->capacity;
        $car->owner_id = $request->owner_id;
        $car->save();
        return  redirect(url('car'));
    }
    public function destroy($id){
        $car = $this->carRepository->findWithoutFail($id);
        
        if (empty($car)) {
            Flash::error('Cart not found');
            return redirect(route('car.index'));
        }
        $this->carRepository->delete($id);

        Flash::success(__('lang.deleted_successfully', ['operator' => __('lang.car')]));

        return redirect(url('car'));
    }

    public function show($id){
        $car = $this->carRepository->findWithoutFail($id);
        $user = User::find($car->owner_id);
        $car->name = $user->name;
        if(isset($user->driver->img_url_id)){
            $car->img_id = $user->driver->img_url_id;
        }
        if(isset($user->driver->img_url_car)){
            $car->img_car_id =  $user->driver->img_url_car;
        }
        if(empty($car)){
            Flash::error('Cart not found');
            return redirect(url('car/'));
        }
        return view('car/show',['car'=>$car]);
    }
    
    public function update(Request $requset,$id){
        
        $car = $this->carRepository->findWithoutFail($id);
        $car->Type = $requset->type;
        $car->brand = $requset->brand;
        $car->color = $requset->color;
        $car->capacity = $requset->capacity;
        $car->number = $requset->number;
        $car->save();
        if(empty($car)){
            Flash::error('Cart not found');
            return redirect(url('car/'));
        }
        return redirect(url('car/data/'.$id));
    }

    private function massage_vaildtion(){
        return
        [
            'owner_id.require'=>'The Owner Name Is Required',
            'Type.require'=>'The Type Is Required',
            'brand.require'=>'The Brand Is Required',
            'color.require'=>'The Color Is Required',
            'number.require'=>'The Number Is Required',
            'capacity.require'=>'The Capacity Is Required',
        ];
    }

    private function rules_validtion(){
        return[
            'Type'=>'required',
            'brand'=>'required',
            'color'=>'required',
            'number'=>'required',
            'capacity'=>'required'
        ];
    }
}
