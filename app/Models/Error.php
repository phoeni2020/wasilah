<?php
namespace App\Models;

use Eloquent as Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Error extends Model  {
    protected $table ='error';
    protected $fillable = ['err_location','err_msg','err_output','http_status','requset_body','api_url','err_desc'];
    
}