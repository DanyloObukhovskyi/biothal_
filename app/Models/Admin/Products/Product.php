<?php

namespace App\Models\Admin\Products;

use App\Models\Categories;
use App\Models\Image;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';

    protected $guarded = [
//        'name',
//        'meta_description',
//        'description',
//        'link',
//        'meta_keywords',
//        'image_id',
//        'sale_id',
//        'composition',
//        'price',
//        'price_with_sale'
    ];

    public function productsAttributes()
    {
        return $this->hasMany('App\Models\Admin\Products\ProductsAttributes','product_id');
    }

    public function getImage()
    {
        return $this->belongsTo(Image::class,'image_id','id');
    }

    public function getSale()
    {
        return $this->hasOne('App\Models\Admin\Products\Sale','id','sale_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Categories::class,'category_products','product_id','category_id');
    }
}


