<?php

namespace App\Http\Controllers\API;


use App\Http\Requests\CreateCarRequest;
use App\Http\Requests\CreateFavoriteRequest;
use App\Models\Car;
use App\Repositories\CarRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Response;
use Prettus\Repository\Exceptions\RepositoryException;
use Flash;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class CartController
 * @package App\Http\Controllers\API
 */

class CarAPIController extends Controller
{
    /** @var  CartRepository */
    private $carRepository;

    public function __construct(CarRepository $carRepo)
    {
        $this->carRepository = $carRepo;
    }

    /**
     * Display a listing of the Cart.
     * GET|HEAD /carts
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try{
            $this->catRepository->pushCriteria(new RequestCriteria($request));
            $this->carRepository->pushCriteria(new LimitOffsetCriteria($request));
        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }
        $carts = $this->carRepository->all();

        return $this->sendResponse($carts->toArray(), 'Car retrieved successfully');
    }
    /**
     * Display a listing of the Cart.
     * GET|HEAD /carts
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function count(Request $request)
    {
        try{
            $this->carRepository->pushCriteria(new RequestCriteria($request));
            $this->carRepository->pushCriteria(new LimitOffsetCriteria($request));
        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }
        $count = $this->carRepository->count();

        return $this->sendResponse($count, 'Count retrieved successfully');
    }
    /**
     * Display the specified Cart.
     * GET|HEAD /carts/{id}
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        /** @var Car $car */
        if (!empty($this->carRepository)) {
            $car = $this->carRepository->findWithoutFail($id);
        }

        if (empty($car)) {
            return $this->sendError('Car not found');
        }

        return $this->sendResponse($car->toArray(), 'Car retrieved successfully');
    }
    /**
     * Store a newly created Cart in storage.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $input = $request->all();
        try {
            
            if(isset($input['reset']) && $input['reset'] == '1'){
                // delete all items in the cart of current user
                $this->carRepository->deleteWhere(['user_id'=> $input['owner_id']]);
            }
            $car = $this->carRepository->create($input);
        } 
        catch (ValidatorException $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($car->toArray(), __('lang.saved_successfully',['operator' => __('lang.car')]));
    }
    
    public function update(Request $request){
        $car = $this->carRepository->where($request->id)->get();
        dd($car);
        if(empty($car->toArray)){
             return $this->sendError('Car not found',404);
        }
        $car->Type = $request->Type;
        $car->brand = $request->brand;
        $car->color = $request->color;
        $car->capacity = $request->capacity;
        $car->number = $request->number;
        $car->save();
        
        return $this->sendResponse($car,'car updated');
    }
    
    /**
     * Remove the specified Favorite from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $cart = $this->carRepository->findWithoutFail($id);

        if (empty($cart)) {
            return $this->sendError('Cart not found');

        }

        $cart = $this->carRepository->delete($id);

        return $this->sendResponse($cart, __('lang.deleted_successfully',['operator' => __('lang.car')]));

    }

}
