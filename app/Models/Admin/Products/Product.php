<?php

namespace App\Models\Admin\Products;

use App\Models\Admin\Accessories\Accessories;
use App\Models\Categories;
use App\Models\CategoryProducts;
use App\Models\Image;
use App\Models\Admin\Products\ProductDescription;
use App\Models\StockStatus;
use Illuminate\Database\Eloquent\Model;

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
        return $this->belongsTo(Image::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImages::class, 'product_id', 'id')->orderBy('sort_order', 'asc')->with('images');
    }

    public function productApts()
    {
        return $this->hasMany(ProductApts::class,'product_id', 'id')->orderBy('sort_order', 'asc');
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

    public function stockStatus () {
        return $this->hasOne(StockStatus::class, 'stock_status_id', 'stock_status_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Categories::class,'category_products','product_id','category_id');
    }

    public function productCategory()
    {
        return $this->hasOne(CategoryProducts::class, 'product_id', 'id');
    }

    public function accessories()
    {
        return $this->belongsToMany(Accessories::class,'accessory_products','product_id','accessory_id');
    }
}


