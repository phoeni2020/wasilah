<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Cart
 * @package App\Models
 * @version September 4, 2019, 3:38 pm UTC
 *
 * @property \App\Models\Product product
 * @property \App\Models\User user
 * @property \Illuminate\Database\Eloquent\Collection options
 * @property integer product_id
 * @property integer user_id
 * @property integer quantity
 */
class Tripe extends Model
{

    public $table = 'tripes';
    


    public $fillable = [
        'tripe_id',
        'user_id',
        'driver_id',
        'start_point_longitude',
        'start_point_latitude',
        'start_point_address',
        'End_point_longitude',
        'End_point_latitude',
        'End_point_address',
        'in_haram',
        'cost',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'tripe_id' => 'integer',
        'user_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    /*public static $rules = [
        'user_id' => 'required|exists:users,id',
        'driver_id'=>'required|exists:users,id',
    ];*/

    /**
     * New Attributes
     *
     * @var array
     */
    protected $appends = [
        'custom_fields'
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
    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class, 'product_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
    public function driver()
    {
        return $this->hasOne(\App\Models\Driver::class, 'user_id', 'driver_id');
    }
}
