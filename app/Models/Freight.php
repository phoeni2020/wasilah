<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Freight extends Model
{
    protected $table='freight';
    protected $casts = [
        'freight_details' => 'string',
        'status' => 'char',
        'user_id'=>'int',
        'phone' => 'string',
        'address' => 'string',
        'longitude' => 'string',
        'latitude' => 'string',
    ];
    protected $fillable = [
        'freight_details',
        'status',
        'user_id',
        'phone',
        'address',
        'longitude',
        'latitude',
        'is_cancelled',
        'driver_id'
    ];

    public function user(){
        return $this->hasOne(\App\Models\User::class,'id');
    }
}