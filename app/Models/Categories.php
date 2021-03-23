<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Models\Admin\Products\Product;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'parent_id', 'title', 'ordering', 'is_demand'
    ];

    public function Category()
    {
        return $this->hasOne(Categories::class,'id','parent_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class,'category_products','category_id','product_id');
    }

    public function children()
    {
        return $this->hasMany(Categories::class,'parent_id','id')->with('Category');
    }

    use HasSlug;

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
}


