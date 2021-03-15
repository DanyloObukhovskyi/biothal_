<?php

namespace App\models\Admin\Products;

use Illuminate\Database\Eloquent\Model;

class InformationAttributes extends Model
{
    protected $table = 'information_attributes';
    protected $primaryKey = 'information_id';
    protected $guarded = [];
}
