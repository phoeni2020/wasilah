<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Payment
 * @package App\Models
 * @version August 29, 2019, 9:39 pm UTC
 *
 * @property \App\Models\User user
 * @property double price
 * @property string description
 * @property string status
 * @property string method
 * @property integer user_id
 */
class Postion extends Model
{
    protected $connection = 'mysql2';
    public $table = 'pos';
    protected $primaryKey = 'user_id';
    public $fillable = [
      'user_id',
      'longa',
      'lat',
      'device_token',
      'in_haram'

    ];

}
