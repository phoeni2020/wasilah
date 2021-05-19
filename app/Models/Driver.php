<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Driver
 * @package App\Models
 * @version March 25, 2020, 9:47 am UTC
 *
 * @property \App\Models\User user
 * @property integer user_id
 * @property double delivery_fee
 * @property integer total_orders
 * @property double earning
 * @property boolean available
 */
class Driver extends Model
{

    public $table = 'drivers';
    public $primaryKey = 'id';



    public $fillable = [
        'user_id',
        'total_fee',
        'total_orders',
        'In_bound',
        'earning',
        'available',
        'img_url_id',
        'img_url_car'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'total_fee' => 'double',
        'total_orders' => 'integer',
        'earning' => 'double',
    ];

    /**
     * Validation rules
     *
     * @var array
     */

    /**
     * New Attributes
     *
     * @var array
     */
    protected $appends = [
        'custom_fields',
        
    ];

    public function customFieldsValues()
    {
        return $this->morphMany('App\Models\CustomFieldValue', 'customizable');
    }

    public function getCustomFieldsAttribute()
    {
        $hasCustomField = in_array(static::class,setting('custom_field_models',[]));
        if (!$hasCustomField){
            return [];
        }
        $array = $this->customFieldsValues()
            ->join('custom_fields','custom_fields.id','=','custom_field_values.custom_field_id')
            ->where('custom_fields.in_table','=',true)
            ->get()->toArray();

        return convertToAssoc($array,'name');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->hasOne(\App\Models\User::class, 'id');
    }
    
    public function tripe(){
        return$this->hasMany(\App\Models\Tripe::class, 'driver_id','user_id');
    }  
    
    public function earn(){
        return$this->belongsTo(\App\Models\Earning::class, 'id');
    }
    
}
