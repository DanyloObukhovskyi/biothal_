<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageGlobal extends Model
{
    protected $table = 'image_global';

    protected $fillable = [
        'name', 'id'
    ];

    public $timestamps = false;
}
