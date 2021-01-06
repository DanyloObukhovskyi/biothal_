<?php

namespace App\Providers;

use App\Models\Admin\Accessories\Accessories;
use App\Models\Admin\Products\GlobalSales;
use App\Models\Admin\Products\Product;
use App\Models\Admin\Products\ProductsAttributes;
use App\Models\Cart_Product;
use App\Models\Categories;
use App\Models\CategoryProducts;
use App\Models\Region;
use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
//use function MongoDB\BSON\toJSON;

class TestServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //TO DO paste in ComposerServiceProvider
        //todo in contoller
        View::composer(['home', 'category', 'product', 'checkout', 'layouts.nav', 'layouts.navCheckout', 'partials.partialsBasket', 'partials.checkout', ], function($view) {
            $view->with(['products' => Product::with('getImage')->get()]);
        });

        View::composer(['partials.partialsBasket', 'partials.checkout', 'layouts.nav', 'layouts.navCheckout'], function($view) {
            $view->with(['global_sale' => GlobalSales::all()]);
        });

        View::composer(['home', 'category', 'product', 'checkout', 'layouts.nav', 'footer', 'layouts.carousel'], function($view) {
            if (session('uuid') == null) {
                $uuid = (string) Str::uuid();
                session(['uuid' => $uuid]);
            } else {
                $uuid = session('uuid');
            }

            $product_price = Product::with('getImage')->where('sale_id', '!=', null)->take(2)->get();
            $product_sale = Product::with('getImage')->where('sale_id', '=', null)->take(2)->get();

            $cart_prod_count = [];
            $countAll = 0;

            $shopping_card = ShoppingCart::where([
                ['uuid', '=', session('uuid')],
                ['user_id', '=', Auth::id()],
            ])->first();

            $cart_join = [];
            if (!empty($shopping_card)) {
                $cart_prod_count = Cart_Product::where([['cart_id', '=', $shopping_card->id]])->get();
                foreach ($cart_prod_count as $key => $value) {
                    $countAll += $value['count'];
                }
                $cart_join = DB::table('cart_products')
                    ->leftJoin('products', 'cart_products.product_id', '=', 'products.id')
                    ->where([['cart_id', '=', $shopping_card->id]])
                    ->get();
            }

            $imagesPath = public_path("storage/img/carousel/"); // путь к папке с глобальными картинками
            $files = []; // массив файлов
            foreach (glob($imagesPath . "*.{jpg,png,gif,jpeg}", GLOB_BRACE) as $filename) { // ищет все картинки через glob
                $files[] = $filename;
            }
            $sum = 0;
            $sum_sale = 0;
            $sumAll = 0;

            foreach ($cart_join as $cart)
            {
                if ((($cart->price_with_sale) == null))
                {
                    $sum += ($cart->price * $cart->count);
                }
                else {
                    $sum_sale += ($cart->price_with_sale * $cart->count);
                }
                $sumAll = ($sum + $sum_sale);
            }

            $region = Region::select('region', 'id')->get()->toArray();
            $region = array_merge([['region' => 'Выберите область']], $region);
            $count_sale_product = Product::with('getImage')->where('sale_id', '!=', null)->count();
            $delivery = 40;
            $view->with([
                'uuid' => $uuid,
                'cart_prod_count' => $cart_prod_count,
                'countAll' => $countAll,
                'sum' => $sum,
                'sumAll' => $sumAll,
                'sum_sale' => $sum_sale,
                'delivery' => $delivery,
                'product_price' => $product_price,
                'product_sale' => $product_sale,
                'region' => $region,
                'cart_products' => Cart_Product::all(),
                'categories' => Categories::all(),
                'accessories' => Accessories::all(),
                'count_sale_product' => $count_sale_product,
                'cart_join' => $cart_join,
                'files' => $files,
            ]);
        });
    }
}
