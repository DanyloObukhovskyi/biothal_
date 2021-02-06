<?php

namespace App\Models\Admin\Products;

use App\Models\Admin\Accessories\Accessories;
use App\Models\Categories;
use App\Models\Image;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';

    protected $guarded = [];

    public function productsAttributes()
    {
        return $this->hasMany('App\Models\Admin\Products\ProductsAttributes','product_id', 'id');
    }

    public function getImage()
    {
        return $this->belongsTo(Image::class,'image_id','id');
    }

    public function getSale()
    {
        return $this->hasOne('App\Models\Admin\Products\Sale','id','sale_id');
    }

    public function productDescription () {
        return $this->hasOne('App\Models\ProductDescription','product_id','id');
    }

    public function productTo1C () {
        return $this->hasOne('App\Models\ProductTo1C', 'product_id', 'id');
    }

    public function categories()
    {
        return $this->belongsToMany(Categories::class,'category_products','product_id','category_id');
    }

    public function productCategory()
    {
        return $this->hasOne('App\Models\CategoryProducts', 'product_id', 'id');    }

    public function accessories()
    {
        return $this->belongsToMany(Accessories::class,'accessory_products','product_id','accessory_id');
    }
}


