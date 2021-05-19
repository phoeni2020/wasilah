<?php

namespace App\Repositories;

use App\Models\Earning;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class EarningRepository
 * @package App\Repositories
 * @version March 25, 2020, 9:48 am UTC
 *
 * @method Earning findWithoutFail($id, $columns = ['*'])
 * @method Earning find($id, $columns = ['*'])
 * @method Earning first($columns = ['*'])
*/
class EarningRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'driver_id',
        'total_trips',
        'total_earning',
        'admin_earning',
        'driver_earning',
        'total_credit_card',
        'is_debt'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Earning::class;
    }
}
