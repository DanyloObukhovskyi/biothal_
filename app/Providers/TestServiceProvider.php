<?php

namespace App\Providers;

use App\Models\Admin\Accessories\Accessories;
use App\Models\Admin\Products\Product;
use App\Models\Cart_Product;
use App\Models\Categories;
use App\Traits\GlobalTrait;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class TestServiceProvider extends ServiceProvider
{
    use GlobalTrait;

    public function register()
    {

    }

    public function boot()
    {
        //TO DO paste in ComposerServiceProvider
        //todo in contoller
        View::composer(['home', 'category', 'product', 'checkout', 'layouts.nav', 'partialsBasket'], function($view) {
            $view->with(['products' => Product::with('getImage')->get()]);
        });

        View::composer(['home', 'category', 'product', 'checkout', 'layouts.nav', 'footer', 'layouts.carousel'], function($view) {
            $data = $this->global_traits();

            $imagesPath = public_path("storage/img/carousel/"); // путь к папке с глобальными картинками
            $files = []; // массив файлов
            foreach (glob($imagesPath . "*.{jpg,png,gif,jpeg}", GLOB_BRACE) as $filename) { // ищет все картинки через glob
                $files[] = $filename;
            }
            $view->with([
                'uuid' =>$data['uuid'],
                'cart_prod_count' => $data['cart_prod_count'],
                'countAll' => $data['countAll'],
                'sum' => $data['sum'],
                'sumAll' => $data['sumAll'],
                'sum_sale' => $data['sum_sale'],
                'delivery' => $data['delivery'],
                'product_price' => $data['product_price'],
                'product_sale' => $data['product_sale'],
                'region' => $data['region'],
                'cart_products' => Cart_Product::all(),
                'categories' => Categories::all(),
                'accessories' => Accessories::all(),
                'count_sale_product' => $data['count_sale_product'],
                'cart_join' => $data['cart_join'],
                'files' => $files,
            ]);
        });
    }
}
