<?php

namespace App\Http\Controllers\API;


use App\Http\Requests\CreateCarRequest;
use App\Http\Requests\CreateFavoriteRequest;
use App\Models\Comment;
use App\Repositories\CommentRepository;
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

class CommentAPIController extends Controller
{
    /** @var  CartRepository */
    private $commentRepository;

    public function __construct(CommentRepository $commentRepo)
    {
        $this->commentRepository = $commentRepo;
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
            $this->commentRepository->pushCriteria(new RequestCriteria($request));
            $this->commentRepository->pushCriteria(new LimitOffsetCriteria($request));
        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }
        $carts = $this->commentRepository->all();

        return $this->sendResponse($carts->toArray(), 'comments retrieved successfully');
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
        try 
        {
            $comment = $this->commentRepository->create($input);
        } 
        catch (ValidatorException $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($comment->toArray(),'comment submited successfully');
    }
    /**
     * Remove the specified Favorite from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function allcomments($id)
    {
        $comments = Comment::where('driver_id','=',$id)->get();
        $count = $comments->count();
        if ($count == 0) {
            return $this->sendError('No review found');
        }
        $sum = $comments->sum('evaluation');
        $res  = $sum / $count;
        $users = array();
        $i = 0;
        foreach($comments as $comment){
            if(isset($comment->user->name)){
            $users[$i]['id'] = $comment->user_id;
            $users[$i]['name'] = $comment->user->name;
            $users[$i]['img_url'] =  $comment->user->img_url;
            $users[$i]['comment'] =  $comment->comment;
            $users[$i]['rate'] = $comment->evaluation;
            $i++;
            }
        }
        $data = ['evaluation'=>number_format($res,1),$users];
        return $this->sendResponse($data, __('lang.deleted_successfully',['operator' => __('lang.car')]));

    }

}
