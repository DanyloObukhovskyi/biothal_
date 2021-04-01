<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
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
use App\Http\Requests\Admin\Orders\OrderPageRequest;
use App\Models\UserOrderAddress;

class OrdersController extends Controller
{
    public function index(OrderPageRequest $request)
    {
        $statuses = ShoppingCart::STATUS;
        $order_statuses = OrderStatuses::all()->toArray();
        $orders = Order::with([
            'userAddress',
            'productHistory',
            'orderStatus',
            'shoppingCart',
            'products'
        ]);
        if (!empty($request->input('filter_order_id'))) {
            $orders = $orders->where('id', $request->input('filter_order_id'));
        }

        if (!empty($request->input('filter_order_status')) &&
            $request->input('filter_order_status') !== "*") {
            $orders = $orders->where('order_status_id', $request->input('filter_order_id'));
        }

        if (!empty($request->input('filter_total'))) {
            $filter_total = $request->input('filter_total');
            $orders = $orders->whereHas('shoppingCart', function ($query) use ($filter_total) {
                $query->where('total', $filter_total);
            });
        }

        if (!empty($request->input('filter_customer'))) {
            $filter_customer = $request->input('filter_customer');
            $orders = $orders->whereHas('userAddress', function ($query) use ($filter_customer) {
                $query->where('full_name', $filter_customer);
            });
        }

        if (!empty($request->input('filter_date_added'))) {
            $orders = $orders->where('created_at', $request->input('filter_date_added'));
        }

        if (!empty($request->input('filter_date_modified'))) {
            $orders = $orders->where('updated_at', $request->input('filter_date_modified'));
        }

        $orders = $orders->get()->toArray();
        foreach ($orders as $order_key => $order) {
            $orders[$order_key]['total_price'] = 0;
            if(!empty($order['products'])){
                foreach($order['products'] as $product){
                    if($product['is_sales']){
                        $orders[$order_key]['total_price'] += ($product['price_with_sales'] * $product['quantity']);
                    } else {
                        $orders[$order_key]['total_price'] += ($product['price'] * $product['quantity']);
                    }
                }
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
            'orderType',
            'shoppingCart',
            'products',
            'user'
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
        $registered_user = UserOrderAddress::where('id', $order['user_order_id'])->first();

        if(!empty($order['user'])){
            $registered_user['type'] = 'Зарегестрированый';
            $registered_user['email'] = $order['user']['email'];
        }
        if(!empty($order['products'])){
            $products = $order['products'];
        }

        if (!empty($order['user_address'])) {
            $order['user_address']['region_name'] = Region::where('id', )->value('region');
            $order['total_price'] = 0;
        }

        $totalPrice = 0;
        $totalSalesPrice = 0;
        $totalProductPrice = 0;
        if(!empty($order['products'])){
            foreach($order['products'] as $product){
                $totalProductPrice += ($product['price'] * $product['quantity']);
                if($product['is_sales']){
                    $totalPrice += ($product['price_with_sales'] * $product['quantity']);
                    $totalSalesPrice += ($product['price'] - $product['price_with_sales']);
                } else {
                    $totalPrice += ($product['price'] * $product['quantity']);
                }
            }
        }


        return view('admin.orders.viewOrders', compact('products',
            'totalPrice',
            'id',
            'order',
            'order_history',
            'order_statuses',
            'registered_user',
            'totalProductPrice',
            'totalSalesPrice'
        ));
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
            'comment' => $request->input('comment') ?? '',
            'status_id' => $request->input('status'),
        ]);

        if ($request->input('override') === 'true') {
            Order::where('id', $request->input('order_id'))
                ->update(['order_status_id' => $request->input('status')]);
        }

        return response()->json(['success' => true]);
    }
}
