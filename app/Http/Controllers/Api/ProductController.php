<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

        $product_category = Categories::where('id', $category_products['category_id'])->first();

        if (!empty($product_category['parent_id'])) {
            $main_product_category = Categories::where('id', $product_category['parent_id'])->first();
        }

        $recommendedProduct = Product::with([
            'image',
            'productDescription',
            'getSale'
        ])
            ->where([
                'is_recommended' => 1,
                'status' => 1
            ])
            ->get();

        $productDetails = Product::with([
                'image',
                'categories',
                'productDescription',
                'productApts',
                'productImages',
                'getSale'
            ])
            ->where( 'id', $id)
            ->first();

        return response()->json([
            'id' => $id,
            'productDetails' => $productDetails,
            'recommendedProduct' => $recommendedProduct,
            'product_category' => $product_category,
            'main_product_category' => $main_product_category
        ]);
    }

    public function getRecommendedProduct()
    {
        $recommendedProduct = Product::with([
            'image',
            'productDescription',
            'getSale'
        ])
            ->where('is_recommended', '=', 1)
            ->get();

        return response()->json($recommendedProduct);
    }
}
