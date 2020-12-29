<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cart\ValidFormModalCheckRequest;
use App\Models\UserOrderAddress;
use GuzzleHttp\Client;
use App\Http\Requests\Cart\ValidCartRequest;
use App\Http\Requests\Cart\ValidFormCheckoutRequest;
use App\Models\Cart_Product;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;



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
            $cartProduct = Cart_Product::create(['cart_id' => $cart->id, 'product_id' => $request->input('product_id'), 'count' => $request->input('count')]);
        } else {
            $cartProduct = Cart_Product::where([['cart_id', $cart->id], ['product_id', '=', $request->input('product_id')]])->update([
                'count' => ($cartProduct['count'] + $request->input('count'))
            ]);
        }

        $countAll = 0;
        $shopping_card = ShoppingCart::where([
            ['uuid', '=', session('uuid')],
            ['user_id', '=', Auth::id()],
        ])->first();

        if (!empty($shopping_card)) {
            $cart_prod_count = Cart_Product::where([['cart_id', '=', $shopping_card->id]])->get();
            foreach ($cart_prod_count as $key => $value) {
                $countAll += $value['count'];
            }
        }
        $html = View::make('partialsBasket', compact('countAll'))->render();
        return response()->json(['html' => $html, 'success' => 1]);
    }

    public function insInCart(ValidCartRequest $request)
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
            $cartProduct = Cart_Product::create(['cart_id' => $cart->id, 'product_id' => $request->input('product_id'), 'count' => $request->input('count')]);
        } else {
            $cartProduct = Cart_Product::where([['cart_id', '=', $cart->id], ['product_id', '=', $request->input('product_id')]])->update([
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

    public function setCheck(Request $request)
    {
        return view('checkout');
    }

    public function checkout(Request $request)
    {
        $cities = $request->input('cities');
        $region = $request->input('region');
        $http = new Client();
        $resp = $http->request('POST', 'https://api.novaposhta.ua/v2.0/json/', [
            'json' => [
                'apiKey' => '3290bef07476a0a0d06726d54cec7d34',
                'modelName' => 'AddressGeneral',
                'calledMethod' => 'getWarehouses',
                'methodProperties' => [

                    "RegionsDescription" => $region,
                    "Language" => "ru",
                    "Limit" => 20,
                    "CityName" => $cities,

                ],
            ]
        ]);

        return response()->json(['data' => json_decode($resp->getBody()->getContents(), true)]);
    }

    public function check(ValidFormCheckoutRequest $request)
    {
        $cart = ShoppingCart::where([
            ['uuid', '=', session('uuid')],
            ['user_id', '=', Auth::id()],
        ])->first();

        ShoppingCart::where([
            ['uuid', '=', session('uuid')],
            ['user_id', '=', Auth::id()],
        ])->update(['order_type_id' => $request->input('order_type')]);

        $UserOrderAddress = UserOrderAddress::where([
            ['phone', '=', $request->input('phone')],
            ['name', '=', $request->input('name')],
            ['LastName', '=', $request->input('LastName')],
            ['region', '=', $request->input('region')],
            ['cities', '=', $request->input('cities')],
            ['department', '=', $request->input('department')],
          ])->first();

        if (empty($UserOrderAddress)) {
            $user_order_address = UserOrderAddress::create([
                'phone' => $request->input('phone'),
                'name' => $request->input('name'),
                'LastName' => $request->input('LastName'),
                'region' => $request->input('region'),
                'cities' => $request->input('cities'),
                'department' => $request->input('department'),
                'not_call' => $request->input('not_call'),
                'shopping_id' => $cart->id,
            ]);
        } else {
            Cart_Product::where([['cart_id', '=', $UserOrderAddress->shopping_id]])->update(['cart_id' => $cart->id]);
            $user_order_address = UserOrderAddress::where([
                ['phone', '=', $request->input('phone')],
                ['name', '=', $request->input('name')],
                ['LastName', '=', $request->input('LastName')],
                ['region', '=', $request->input('region')],
                ['cities', '=', $request->input('cities')],
                ['department', '=', $request->input('department')],
            ])->update(['shopping_id' => $cart->id, 'not_call' => $request->input('not_call')]);
        }

        return response()->json(['success' => 1]);
    }

    public function checkModalOneClick(ValidFormModalCheckRequest $request)
    {
        $cart = ShoppingCart::where([
            ['uuid', '=', session('uuid')],
            ['user_id', '=', Auth::id()],
        ])->first();

        ShoppingCart::where([
            ['uuid', '=', session('uuid')],
            ['user_id', '=', Auth::id()],
        ])->update(['order_type_id' => $request->input('order_type')]);

        $UserOrderAddress = UserOrderAddress::where([
            ['phone', '=', $request->input('phone')],
            ['name', '=', $request->input('name')],
        ])->first();

        if (empty($UserOrderAddress)) {
            $user_order_address = UserOrderAddress::create([
                'phone' => $request->input('phone'),
                'name' => $request->input('name'),
                'shopping_id' => $cart->id,
            ]);
        } else {
            Cart_Product::where([['cart_id', '=', $UserOrderAddress->shopping_id]])->update(['cart_id' => $cart->id]);
            $user_order_address = UserOrderAddress::where([
                ['phone', '=', $request->input('phone')],
                ['name', '=', $request->input('name')],
            ])->update(['shopping_id' => $cart->id]);
        }

        return response()->json(['success' => 1]);
    }

    public function ajax(Request $request)
    {

    }
}
