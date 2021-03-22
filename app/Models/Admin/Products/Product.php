<?php

namespace App\Models\Admin\Products;

use App\Models\Image;
use App\Models\Categories;
use App\Models\CategoryProducts;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Accessories\Accessories;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';

    protected $guarded = [];

    public function productsAttributes()
    {
        return $this->hasMany(ProductsAttributes::class,'product_id', 'id');
    }

    public function image()
    {
        return $this->hasOne(Image::class,'id','id');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImages::class);
    }

    public function productApts()
    {
        return $this->hasMany(ProductApts::class);
    }

    public function getSale()
    {
        return $this->hasOne(Sale::class,'id','sale_id');
    }

    public function productDescription () {
        return $this->hasOne(ProductDescription::class,'product_id','id');
    }

    public function productTo1C () {
        return $this->hasOne(ProductTo1C::class, 'product_id', 'id');
    }

    public function categories()
    {
        return $this->belongsToMany(Categories::class,'category_products','product_id','category_id');
    }

    public function productCategory()
    {
        return $this->hasOne(CategoryProducts::class, 'product_id', 'id');    }

    public function accessories()
    {
        return $this->belongsToMany(Accessories::class,'accessory_products','product_id','accessory_id');
    }
}


