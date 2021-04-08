<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CheckoutRequest;
use App\Models\Admin\Products\GlobalSales;
use App\Models\Admin\Products\Product;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderStatuses;
use App\Models\OrderType;
use App\Models\PaymentMethod;
use App\Models\User;
use App\Models\UserOrderAddress;
use App\Rules\PhoneValidation;
use App\Services\NovaPoshtaService;
use App\Services\PortmoneService;
use Crypt;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderCreated;

class CheckoutController extends Controller
{
    /**
     * @var NovaPoshtaService
     */
    public NovaPoshtaService $novaPoshtaService;


    public PortmoneService $portmoneService;

    /**
     * CheckoutController constructor.
     */
    public function __construct()
    {
        $this->novaPoshtaService = new NovaPoshtaService();
        $this->portmoneService = new PortmoneService();
    }

    public function getRegions()
    {
        $regions = $this->novaPoshtaService->getRegions();

        return response()->json($regions);
    }

    public function getRegionCities(Request $request)
    {
        $region = $request->get('region');

        $cities = $this->novaPoshtaService
            ->getRegionCities($region);

        return response()->json($cities);
    }

    public function getPostalOffices(Request $request)
    {
        $city = $request->get('city');

        $postalOffices = $this->novaPoshtaService
            ->getPostalOffices($city);

        return response()->json($postalOffices);
    }

    public function getPaymentMethods()
    {
        $paymentMethods = OrderType::all();

        return response()->json($paymentMethods);
    }

    public function createOrder(Request $request)
    {
        $postalOffice = (object)$request->get('postalOffice');

        $userOrderAddress = new UserOrderAddress();
        $userOrderAddress->phone = $request->get('number');
        $userOrderAddress->name = $request->get('name');
        $userOrderAddress->LastName = $request->get('surname');
        $userOrderAddress->region = $request->get('region');
        $userOrderAddress->cities = $request->get('city');
        $userOrderAddress->department = $postalOffice->name;
        $userOrderAddress->department_number = $postalOffice->number;
        $userOrderAddress->full_name = $request->get('name') . ' ' . $request->get('surname');
        $userOrderAddress->save();

        $orderStatus = OrderStatuses::where('name', OrderStatuses::ACTIVE)
            ->first();

        $order = new Order();
        $order->user_order_id = $userOrderAddress->id;
        $order->order_status_id = $orderStatus->id;
        $order->order_type_id = $request->get('paymentMethod');
        $order->user_id = $request->get('user_id');

        $order->save();

        $total = 0;
        $orderProducts = [];
        foreach ($request->get('products') as $product) {

            $orderProduct = new OrderProduct();
            $orderProduct->product_id = $product['id'];
            $orderProduct->order_id = $order->id;
            $orderProduct->quantity = $product['quantity'];
            $orderProduct->price = $product['price'];
            $orderProduct->price_with_sales = $product['price_with_sale'];
            $orderProduct->sale_id = $product['sale_id'];
            $orderProduct->is_sales = !empty($product['sale_id']) ? 1 : 0 ;
            $orderProduct->percent = !empty($product['sale_id']) ? $product['get_sale']['percent'] : null;
            $orderProduct->save();

            $orderProducts[] = $orderProduct;
            $total += !empty($product['sale_id']) ? $product['price_with_sale'] * $product['quantity'] : $product['price'] * $product['quantity'];
        }
        $globalSale = GlobalSales::where('sum_modal', '<=', $total)
            ->orderBy('procent_modal', 'desc')
            ->first();
        if (isset($globalSale)) {
            $amountPercent = $total / 100 * $globalSale->procent_modal;
            $total = $total - $amountPercent;
        }
        $order->total_sum = $total;
        $order->save();
        $orderType = OrderType::find($request->get('paymentMethod'));

        if (isset($orderType) and OrderType::CARD_METHOD === $orderType->type) {
            $amount = 0;

            foreach ($orderProducts as $orderProduct) {
                if ($orderProduct->is_sales) {
                    $amount += $orderProduct->price_with_sales;
                } else {
                    $amount += $orderProduct->price;
                }
            }

            $globalSale = GlobalSales::where('sum_modal', '<=', $amount)
                ->orderBy('procent_modal', 'desc')
                ->first();

            if (isset($globalSale)) {
                $amountPercent = $amount / 100 * $globalSale->procent_modal;
                $amount = $amount - $amountPercent;
            }

            $portmoneUrl = $this->portmoneService->makeRequest(
                $amount,
                $order
            );

            return response()->json([
                'message' => 'Заказ оформлен!',
                'portmone' => $portmoneUrl
            ]);
        }

        return response()->json([
            'order_id' => $order->user_order_id,
            'message' => 'Заказ оформлен!'
        ]);
    }

    public function getOrder($id)
    {
        $order = Order::with('userAddress')->where('user_order_id', $id)->first();

        return response()->json([
            'message' => 'Заказ в обработке!'
        ]);
    }

    public function createQuickOrder(Request $request)
    {

        $userOrderAddress = new UserOrderAddress();
        $userOrderAddress->phone = $request->get('number');
        $userOrderAddress->name = $request->get('name');
        $userOrderAddress->save();

        $orderStatus = OrderStatuses::where('name', OrderStatuses::ACTIVE)
            ->first();

        $order = new Order();
        $order->user_order_id = $userOrderAddress->id;
        $order->order_status_id = $orderStatus->id;
        $order->order_type_id = 1;
        $order->user_id = $request->get('user_id');
        $order->save();

        $total = 0;
        foreach ($request->get('products') as $product) {

            $orderProduct = new OrderProduct();
            $orderProduct->product_id = $product['id'];
            $orderProduct->order_id = $order->id;
            $orderProduct->quantity = $product['quantity'];
            $orderProduct->price = $product['price'];
            $orderProduct->price_with_sales = $product['price_with_sale'];
            $orderProduct->sale_id = $product['sale_id'];
            $orderProduct->is_sales = !empty($product['sale_id']) ? 1 : 0 ;
            $orderProduct->percent = !empty($product['sale_id']) ? $product['get_sale']['percent'] : null;
            $orderProduct->save();

            $total += !empty($product['sale_id']) ? $product['price_with_sale'] *  $product['quantity']: $product['price'] * $product['quantity'];
        }
        $globalSale = GlobalSales::where('sum_modal', '<=', $total)
            ->orderBy('procent_modal', 'desc')
            ->first();
        if (isset($globalSale)) {
            $amountPercent = $total / 100 * $globalSale->procent_modal;
            $total = $total - $amountPercent;
        }
        $order->total_sum = $total;
        $order->save();

        $orderType = OrderType::find(1);

        return response()->json([
            'order_id' => $order->user_order_id,
            'message' => 'Заказ оформлен!'
        ]);
    }

    public function createQuickOrderFromProduct(Request $request)
    {

        $userOrderAddress = new UserOrderAddress();
        $userOrderAddress->phone = $request->get('phone');
        $userOrderAddress->save();

        $orderStatus = OrderStatuses::where('name', OrderStatuses::ACTIVE)
            ->first();

        $order = new Order();
        $order->user_order_id = $userOrderAddress->id;
        $order->order_status_id = $orderStatus->id;
        $order->order_type_id = 1;
        $order->user_id = $request->get('user_id');
        $order->save();

        $product = $request->get('product');
        $total = 0;

        $orderProduct = new OrderProduct();
        $orderProduct->product_id = $product['id'];
        $orderProduct->order_id = $order->id;
        $orderProduct->quantity = $product['quantity'];
        $orderProduct->price = $product['price'];
        $orderProduct->price_with_sales = $product['price_with_sale'];
        $orderProduct->sale_id = $product['sale_id'];
        $orderProduct->is_sales = !empty($product['sale_id']) ? 1 : 0 ;
        $orderProduct->percent = !empty($product['sale_id']) ? $product['get_sale']['percent'] : null;
        $orderProduct->save();
        $total += !empty($product['sale_id']) ? $product['price_with_sale'] : $product['price'];
        $total = $total * $product['quantity'];
        $globalSale = GlobalSales::where('sum_modal', '<=', $total)
            ->orderBy('procent_modal', 'desc')
            ->first();
        if (isset($globalSale)) {
            $amountPercent = $total / 100 * $globalSale->procent_modal;
            $total = $total - $amountPercent;
        }
        $order->total_sum = $total;
        $order->save();

        $orderType = OrderType::find(1);

        return response()->json([
            'order_id' => $order->user_order_id,
            'message' => 'Заказ оформлен!'
        ]);
    }

    public function createPreOrder(Request $request)
    {
        if (!empty($request->get('user_id'))) {
            $user = User::where('id', $request->get('user_id'))->first();
        } else {
            $user = null;
        }

        $userOrderAddress = new UserOrderAddress();
        $userOrderAddress->phone = $request->get('phone');
        $userOrderAddress->name =  $request->get('name');
        $userOrderAddress->LastName = $user ? $user->sur_name ?? '': null;
        $userOrderAddress->full_name = $user ? $user->name . ' ' . $user->sur_name ?? '' : null;
        $userOrderAddress->save();

        $order = new Order();
        $order->user_order_id = $userOrderAddress->id;
        $order->order_status_id = 5;
        $order->order_type_id = 0;
        $order->user_id = $request->get('user_id');
        $order->save();

        $product = $request->get('product');

        $orderProduct = new OrderProduct();
        $orderProduct->product_id = $product['id'];
        $orderProduct->order_id = $order->id;
        $orderProduct->quantity = 0;
        $orderProduct->price = 0;
        $orderProduct->price_with_sales = 0;
        $orderProduct->sale_id = $product['sale_id'];
        $orderProduct->is_sales = !empty($product['sale_id']) ? 1 : 0 ;
        $orderProduct->percent = !empty($product['sale_id']) ? $product['get_sale']['percent'] : null;
        $orderProduct->save();

        $order->total_sum = 0;
        $order->save();

        return response()->json([
            'order_id' => $order->user_order_id,
            'message' => 'Предзаказ оформлен!'
        ]);
    }

    public function sendOrderStatus(Request $request)
    {
        $orderId = $request->data;
        if(!empty($orderId)){
            $order = Order::where('id', $orderId)->with('userAddress')->first();
            if(!empty($order->userAddress->email)){
                Mail::to($order->userAddress->email)->send(new OrderCreated($order));
            }
        }
    }
}
