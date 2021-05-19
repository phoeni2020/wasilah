<?php

namespace App\Http\Controllers\API;


use App\Models\Payment;
use App\Repositories\PaymentRepository;
use App\Repositories\EarningRepository;
use App\Repositories\TripRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Response;
use Prettus\Repository\Exceptions\RepositoryException;
use Flash;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class PaymentController
 * @package App\Http\Controllers\API
 */
class PaymentAPIController extends Controller
{
    /** @var  PaymentRepository */
    private $paymentRepository;
    private $earnRepository;
    private $tripeRepository;
    private $userRepository;
    private $fci_key;
    
    public function __construct(PaymentRepository $paymentRepo , EarningRepository $earn , TripRepository $tripe ,UserRepository $user)
    {
        $this->paymentRepository = $paymentRepo;
        $this->earnRepository = $earn;
        $this->tripeRepository = $tripe;
        $this->userRepository = $user; 
        $this->fci_key = 'AAAAi3azM_s:APA91bFlUDFzgzkItmM7JezRafuKeOVXEjc5Y5-ss68FhWCgdciH5mVIVeb0VQZyfhsfTpaXtGcVfTRoMzbK1_knjGxAX-M9yq6M3hzoTkODt59dByRCL4UkwBB94Hjj5SB5OVKQ7vpE';

    }

    /**
     * Display a listing of the Payment.
     * GET|HEAD /payments
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $this->paymentRepository->pushCriteria(new RequestCriteria($request));
            $this->paymentRepository->pushCriteria(new LimitOffsetCriteria($request));
        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }
        $payments = $this->paymentRepository->all();

        return $this->sendResponse($payments->toArray(), 'Payments retrieved successfully');
    }

    /**
     * Display the specified Payment.
     * GET|HEAD /payments/{id}
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        /** @var Payment $payment */
        if (!empty($this->paymentRepository)) {
            $payment = $this->paymentRepository->findWithoutFail($id);
        }

        if (empty($payment)) {
            return $this->sendError('Payment not found');
        }

        return $this->sendResponse($payment->toArray(), 'Payment retrieved successfully');
    }

    public function byMonth()
    {
        $payments = [];
        if (!empty($this->paymentRepository)) {
            $payments = $this->paymentRepository->orderBy("created_at",'asc')->all()->map(function ($row) {
                $row['month'] = $row['created_at']->format('M');
                return $row;
            })->groupBy('month')->map(function ($row) {
                return $row->sum('price');
            });
        }
        return $this->sendResponse([array_values($payments->toArray()),array_keys($payments->toArray())], 'Payment retrieved successfully');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        try {
            if($request->is_driver == 1)
            {
                $payment = $this->paymentRepository->create($input);
                $earn = $this->earnRepository->findWithoutFail($input['driver_id']);
                $tripe  = $this->tripeRepository->findWithoutFail($input['tripe_id']);
                $tripe->status = 2;
                $tripe->save();
                $price = $input['price'];
                $earn->total_earning = $input['price'] + $earn->total_earning;
                $earn->total_trips = $earn->total_trips+1;
                $fee = ($payment->price * 10)/100;
                $earn->driver_earning = ($payment->price - $fee) + $earn->driver_earning;
                $earn->admin_earning = $fee + $earn->admin_earning;
                $earn->update();
                $fields = array(
                    'priority'=> 'high',
                    'data' =>array(
                    'type'=>'payment',
                    'price'=>"$price",
                    ),
                    'notification' => [
                    'title' =>'Garden Taxi New Tripe Request',],
                );
                define('FIREBASE_API_KEY','AAAAkowAW4g:APA91bEifs_dsM_qTCuenPp5516bqj157pJPJMknXgZWANVXsgIqOVVHKuhX6MVH5uHilYAYsB6EQAWOIvJ7dmZA_rvspEXonJ8dm6fYF6J_tPE4oAEVDXFxJ0EsDyIgRtsxWYdzRx_9');
                $headers = array(
                    'Content-Type: application/json',
                    'Authorization: key=' . $this->fci_key,
                );
                $to = $this->userRepository->findWithoutFail($input['driver_id']);
                $fields['to']=$to->device_token;
                $ch = curl_init();
                curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
                curl_setopt( $ch,CURLOPT_POST, true );
                curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
                $result = curl_exec($ch);
                curl_close( $ch );    
            }
            elseif($request->is_driver == 0)
            {
                $payment = $this->paymentRepository->create($input);
                $earn = $this->earnRepository->findWithoutFail($input['driver_id']);
                $tripe  = $this->tripeRepository->findWithoutFail($input['tripe_id']);
                $tripe->status = 2;
                $tripe->save();
                $price = $input['price'];
                $earn->total_earning = $input['price'] + $earn->total_earning;
                $earn->total_trips = $earn->total_trips+1;
                $fee = ($payment->price * 10)/100;
                $earn->driver_earning = ($payment->price - $fee) + $earn->driver_earning;
                $earn->admin_earning = $fee + $earn->admin_earning;
                $earn->update();
                $fields = array(
                    'priority'=> 'high',
                    'data' =>array(
                    'type'=>'payment',
                    'price'=>"$price",
                    ),
                    'notification' => [
                    'title' =>'Garden Taxi The User Has Ended The Tripe',],
                );
                $headers = array(
                    'Content-Type: application/json',
                    'Authorization: key=' . $this->fci_key,
                );
                $to = $this->userRepository->findWithoutFail($input['driver_id']);
                $fields['to']=$to->device_token;
                $ch = curl_init();
                curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
                curl_setopt( $ch,CURLOPT_POST, true );
                curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
                $result = curl_exec($ch);
                curl_close( $ch ); 
            }
            else
            {
                return $this->sendError('BAD REQUEST: No Value Has been Set For The Tripe Ending User B',400);
            }
        }
        catch (ValidatorException $e) {
            return $this->sendError($e->getMessage());
        }
        return $this->sendResponse($payment, __('lang.saved_successfully',['operator' => __('lang.app_setting_payment')]));
    }

}
