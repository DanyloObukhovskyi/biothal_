<?php

namespace App\Models\Admin\Accessories;

use App\Models\Admin\Products\Product;
use Illuminate\Database\Eloquent\Model;

class Accessories extends Model
{
    protected $table = 'accessories';

    protected $guarded = [];

    public function Accessory()
    {
        return $this->hasOne(Accessories::class,'id','parent_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class,'accessory_products','accessory_id','product_id');
    }

}
