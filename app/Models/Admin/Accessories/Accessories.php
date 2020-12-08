<?php

namespace App\Models\Admin\Accessories;

use Illuminate\Database\Eloquent\Model;

class Accessories extends Model
{
    protected $table = 'accessories';

    protected $guarded = [];

    public function Accessory()
    {
        return $this->hasOne(Accessories::class,'id','parent_id');
    }
}
