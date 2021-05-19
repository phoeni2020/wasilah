<?php

namespace App\Repositories;

use App\Models\Car;
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
class CarRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'type',
        'brand',
        'color',
        'number',
        'capacity',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Car::class;
    }
}
