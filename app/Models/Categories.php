<?php

namespace App\Models;

use App\Models\Admin\Products\Information;
use App\Models\Admin\Products\InformationAttributes;
use App\Models\Admin\Products\InformationToLayout;
use Illuminate\Support\Arr;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Models\Admin\Products\Product;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';

    protected $guarded = [];

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

    public function childrenArticle()
    {
//        $information_ids = InformationToLayout::select('information_id')->whereIn('layout_id', Arr::pluck($info_categories, 'id'))->get();
//        $bottom_article = Information::whereIn('information_id', Arr::pluck($information_ids, 'information_id'))
//            ->where('bottom', 1)
//            ->get();
//        return InformationAttributes::whereIn('information_id', Arr::pluck($bottom_article, 'information_id'))->get();
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

    public function childrenInformation()
    {
        return $this->hasMany(InformationToLayout::class,'layout_id','id')->with(['info','attribute']);
    }
}


