<?php

namespace App\Repositories;

use App\Models\Tripe;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CartRepository
 * @package App\Repositories
 * @version September 4, 2019, 3:38 pm UTC
 *
 * @method Cart findWithoutFail($id, $columns = ['*'])
 * @method Cart find($id, $columns = ['*'])
 * @method Cart first($columns = ['*'])
*/
class TripRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'tripe_id',
        'user_id',
        'driver_id',
        'start_point_longitude',
        'start_point_latitude',
        'End_point_longitude',
        'End_point_latitude',
        'in_ahram',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Tripe::class;
    }
}
