<?php

namespace App\Models\Admin\Products;

use App\Models\Admin\Products\Information;
use App\Models\Admin\Products\InformationAttributes;
use Illuminate\Database\Eloquent\Model;

class InformationToLayout extends Model
{
    protected $table = 'information_to_layout';
    protected $primaryKey = 'information_id';
    protected $guarded = [];

    public function info()
    {
        return $this->hasOne(Information::class,'information_id','information_id');
    }

    public function attribute()
    {
        return $this->hasOne(InformationAttributes::class,'information_id','information_id');
    }
}
