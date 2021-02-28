<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Models\{
    User,
    Order,
    Region,
    Cart_Product,
    OrderHistory,
    ShoppingCart,
    OrderStatuses,
};
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index(Request $request)
    {
        $statuses = ShoppingCart::STATUS;
        $order_statuses = OrderStatuses::all()->toArray();
        $orders = Order::with([
            'userAddress',
            'productHistory',
            'orderStatus',
            'shoppingCart'
        ])->get()->toArray();

        foreach ($orders as $order_key => $order) {
            if (!empty($order['shopping_cart'])) {
                $products = Cart_Product::where('cart_products.cart_id', $order['shopping_cart']['id'])
                    ->join('products', 'cart_products.product_id', '=', 'products.id')->get()->toArray();
                $total_price = 0;
                foreach ($products as $product) {
                    $price = (!empty($product['price_with_sale'])) ? $product['price_with_sale'] : $product['price'];
                    $total_price += $price * $product['count'];
                }

                $orders[$order_key]['total_price'] = $total_price;
            }
        }

        return view('admin.orders.orders', [
            'statuses' => $statuses,
            'orders' => $orders,
            'order_statuses' => $order_statuses
        ]);
    }

    public function viewOrders($id, Request $request) {
        $order_statuses = [];
        $_statuses = OrderStatuses::all()->toArray();
        foreach ($_statuses as $status) {
            $order_statuses[$status['id']] = $status;
        }

        $order = Order::where('id', $id)->with([
            'userAddress',
            'productHistory',
            'orderStatus',
            'shoppingCart'
        ])->first()->toArray();

        $order_history = OrderHistory::where('order_id', $id)->paginate(5);

        if (empty($order)) {
            return response()->json([], 404);
        }

        $products = [];
        $registered_user = null;
        if (!empty($order['shopping_cart'])) {
            $products = Cart_Product::where('cart_products.cart_id', $order['shopping_cart']['id'])
                ->join('products', 'cart_products.product_id', '=', 'products.id')->get()->toArray();
            if (!empty($order['shopping_cart']['user_id'])) {
                $registered_user = User::where('id', $order['shopping_cart']['user_id'])->first();
            }
        }

        if (!empty($order['user_address'])) {
            $order['user_address']['region_name'] = Region::where('id', )->value('region');
        }

        $total_price = 0;
        foreach ($products as $product) {
            $price = (!empty($product['price_with_sale'])) ? $product['price_with_sale'] : $product['price'];
            $total_price += $price * $product['count'];
        }

        return view('admin.orders.viewOrders', compact('products',
            'total_price',
            'id',
            'order',
            'order_history',
            'order_statuses',
            'registered_user'));
    }

    public function getOrderHistoryByPage (Request $request) {
        $id = $request->input('id');
        $order_statuses = [];
        $_statuses = OrderStatuses::all()->toArray();
        foreach ($_statuses as $status) {
            $order_statuses[$status['id']] = $status;
        }
        $order_history = OrderHistory::where('order_id', $id)->paginate(5);
        $html = View::make('admin.orders.partials.orderHistoryPartial',
            compact('order_history', 'id', 'order_statuses'))
            ->render();

        return response()->json(['html' => $html]);
    }

    public function saveHistory (Request $request) {
        OrderHistory::create([
            'order_id' => $request->input('order_id'),
            'notify' => ($request->input('notify') === 'true') ? 1 : 0,
            'comment' => $request->input('comment'),
            'status_id' => $request->input('status'),
        ]);

        if ($request->input('override') === 'true') {
            Order::where('id', $request->input('order_id'))
                ->update(['order_status_id' => $request->input('status')]);
        }

        return response()->json(['success' => true]);
    }
}
