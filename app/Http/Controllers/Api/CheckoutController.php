<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CheckoutRequest;
use App\Models\Admin\Products\GlobalSales;
use App\Models\Admin\Products\Product;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderStatuses;
use App\Models\PaymentMethod;
use App\Models\UserOrderAddress;
use App\Rules\PhoneValidation;
use App\Services\NovaPoshtaService;
use App\Services\PortmoneService;
use Crypt;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

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
        $paymentMethods = PaymentMethod::all();

        return response()->json($paymentMethods);
    }

    public function createOrder(Request $request)
    {
        $postalOffice = (object)$request->get('postalOffice');
        $paymentMethod = (object)$request->get('paymentMethod');

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
        $order->payment_method_id = $paymentMethod->id;
        $order->order_type_id = 0;
        $order->save();

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
        }

        if (PaymentMethod::CARD_METHOD === $paymentMethod->type) {
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
                'redirect' => $portmoneUrl
            ]);
        }

        return response()->json([
            'message' => 'Заказ оформлен!'
        ]);
    }
}
