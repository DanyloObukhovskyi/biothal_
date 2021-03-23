<?php

namespace App\Http\Controllers;

use App\Models\Admin\Products\Product;
use App\Models\Admin\Products\ProductImages;
use App\Models\Categories;
use App\Models\CategoryProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function getProduct($id){
        $category_products = CategoryProducts::where('product_id', $id)->first();

        $catProd_category_id = $category_products['category_id'];
        $category_string = '';
        $product_cat = Categories::where('id', $category_products['category_id'])->first();
        if (!empty($product_cat['parent_id'])) {
            $main_cat = Categories::where('id', $product_cat['parent_id'])->first();
        }
        $category_string = (!empty($main_cat['title'])) ? $main_cat['title'] : '';
        if (!empty($category_srting)) {
            $category_srting .= (!empty($product_cat['title'])) ? " / " . $product_cat['title'] : '' ;
        } else {
            $category_srting = (!empty($product_cat['title'])) ? $product_cat['title'] : '' ;
        }
        $products = Product::with('image', 'categories')->get();

        $recommendedProduct = Product::with('image', 'productDescription')->where('is_recommended', '=', 1)->get();

        $productDetails = Product::with('image', 'categories', 'productDescription', 'productApts', 'productImages')->where( 'id', $id)->first();

        return response()->json([
            'id' => $id,
            'products' => $products,
            'productDetails' => $productDetails,
            'category_products' => $category_products,
            'catProd_category_id' => $catProd_category_id,
            'recommendedProduct' => $recommendedProduct,
            'category_string' => $category_string
        ]);
    }
}
