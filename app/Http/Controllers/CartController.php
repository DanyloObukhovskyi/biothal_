<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cart\ValidCartRequest;
use App\Models\Cart_Product;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LisDev\Delivery\NovaPoshtaApi2;

class CartController extends Controller
{
    public function insInCartHome(Request $request)
    {
        $cart = ShoppingCart::where([
            ['uuid', '=', session('uuid')],
            ['user_id', '=', Auth::id()],
        ])->first();

        if (empty($cart)) {
            $cart = ShoppingCart::create([
                'uuid' => session('uuid'),
                'user_id' => Auth::id(),
            ]);
        }
        $cartProduct = Cart_Product::where([
            ['cart_id', '=', $cart->id],
            ['product_id', '=', $request->input('product_id')],
        ])->first();

        if (empty($cartProduct)) {
            $cartProduct = Cart_Product::create(['cart_id' => $cart->id,  'product_id' => $request->input('product_id'), 'count' => $request->input('count')]);
        }
        else {
            $cartProduct = Cart_Product::where([['cart_id', $cart->id],['product_id', '=', $request->input('product_id')]])->update([
                'count' => ($cartProduct['count'] + $request->input('count'))
            ]);
        }
        return response()->json(['success' => 1]);
    }

    public function insInCart(ValidCartRequest $request){
        $cart = ShoppingCart::where([
            ['uuid', '=', session('uuid')],
            ['user_id', '=', Auth::id()],
        ])->first();

        if (empty($cart)) {
            $cart = ShoppingCart::create([
                'uuid' => session('uuid'),
                'user_id' => Auth::id(),
            ]);
        }

        $cartProduct = Cart_Product::where([
            ['cart_id', '=', $cart->id],
            ['product_id', '=', $request->input('product_id')],
        ])->first();

        if (empty($cartProduct)) {
            $cartProduct = Cart_Product::create(['cart_id' => $cart->id,  'product_id' => $request->input('product_id'), 'count' => $request->input('count')]);
        }
        else {
            $cartProduct = Cart_Product::where([['cart_id', $cart->id],['product_id', '=', $request->input('product_id')]])->update([
                'count' => ($cartProduct['count'] + $request->input('count'))
            ]);
        }
        return response()->json(['success' => 1]);
    }

    public function delCart(Request $request)
    {
        Cart_Product::where('product_id', '=', $request->input('product_id'))->delete();
        return response()->json(['success' => 1]);
    }

    public function checkout(Request $request)
    {
//        $np = new NovaPoshtaApi2('3290bef07476a0a0d06726d54cec7d34');
//        dd($np);
        return view('checkout');
    }
}
