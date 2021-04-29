<?php


namespace App\Traits;

use App\Models\Order;
use App\Models\OrderStatuses;
use Carbon\Carbon;

trait OrdersTrait
{
    /**
     * Method for get data with order_import = 0 status.
     *
     * @param array $relations - relation name from App\Models\ShoppingCart model
     * @return array
     */
    public function getNotImportedOrderData($relations = []) {
        $dataQuery = $this->order->where('import_status', 0);
        if (!empty($relations)) {
            foreach ($relations as $relation) {
                $dataQuery = $dataQuery->with($relation);
            }
        }

        return $dataQuery->get()->toArray();
    }

    /**
     * Method for generate array for convert order to XML
     *
     * @param $orders
     * @return array
     */
    public function prepareXmlArray ($orders) {
        $xmlData = [];
        foreach ($orders as $order) {
            if($order['order_type_id'] === 2){
                if(!empty($order['payment'])){
                    Order::find($order['id'])->update([
                        'import_status' => 0
                    ]);
                    if($order['payment']['status'] !== 'success'){
                        continue;
                    }
                } else {
                    continue;
                }
            } else {
                Order::find($order['id'])->update([
                    'import_status' => 0
                ]);
            }
            $xmlBody = [];
            $xmlBody["Ид"] = $order['id'];
            $xmlBody["Номер"] = $order['id'];
            $xmlBody["Дата"] = Carbon::parse($order['created_at'])->format('Y-m-d H:i:s');
            $xmlBody["ХозОперация"] = "Заказ товара";
            $xmlBody["Роль"] = "Покупатель";
            $xmlBody["Валюта"] = "GRN";
            $xmlBody["Курс"] = "1";
            $xmlBody["Сумма"] = $order['total_sum'];
            $counterparty = [];
            if (!empty($order['user_address'])) {
                $counterparty = $this->getCounterpartyData($order['user_address']);
            }

            $xmlBody["Контрагенты"] = (!empty($counterparty["counterparty"]))
                ? $counterparty["counterparty"]
                : "";

            $xmlBody["Комментарий"] = (!empty($counterparty["comment"]))
                ? $counterparty["comment"]
                : "";

            $products = '';
            if (!empty($order["products"])) {
                $products = $this->getProductsData($order["products"]);
            }

            $xmlBody["Товары"] = (!empty($products["products"]))
                ? $products["products"]
                : "";

            $xmlBody["Сумма"] = (!empty($order["total_sum"]))
                ? $order["total_sum"]
                : 0;

            //TODO: optimize this part
            $status = OrderStatuses::where('id', $order['order_status_id'])->first()->name;
            $orderType = $order['order_type_id'] === 1 ? 'Наложка' : 'Оплачен';
            $xmlBody["ЗначенияРеквизитов"]["ЗначениеРеквизита"][] = [
                "Наименование" => "Статус заказа",
                "Значение" => $orderType
            ];

            $xmlBody["ЗначенияРеквизитов"]["ЗначениеРеквизита"][] = [
                "Наименование" => "Способ доставки",
                "Значение" => "Получении через Новую Почту",
            ];

            $xmlBody["ЗначенияРеквизитов"]["ЗначениеРеквизита"][] = [
                "Наименование" => "Способ оплаты",
                "Значение" => $order['order_type']['title']
            ];

            $xmlData["Документ"][] = $xmlBody;
        }

        return $xmlData;
    }

    /**
     * Method generate array for "Контрагенты" xml field.
     *
     * @param $userData
     * @return array
     */
    public function getCounterpartyData ($userData) {
        $comment = $userData['id'] . " Тел.: " . $userData['phone'] .
            "  Имя: " . $userData['LastName'] . " " . $userData['name'] . " Адрес: "  .
            implode(", ", [ $userData['region'], $userData['department'] ]);

        return [
            "counterparty" => [
                "Контрагент" => [
                    "Ид" => $userData['id'],
                    "Наименование" => $userData['name'],
                    "ПолноеНаименование" => $userData['LastName'] . " " . $userData['name'],
                    "Роль" => "Покупатель",
                    "Фамилия" => $userData['LastName'],
                    "Имя" => $userData['name'],
                    "АдресРегистрации" => [
                        "Представление" => implode(", ", [
                            $userData['region'],
                            $userData['department'],
                        ]),
                        "Контакты" => [
                            "Контакт" => [
                                "Тип" => "Телефон",
                                "Значение" => $userData['phone']
                            ]
                        ]

                    ]

                ]
            ],

            "comment" => $comment
        ];
    }

    /**
     * Method for generate array for "Товары" xml field.
     *
     * @param $products
     * @return array
     */
    public function getProductsData ($products) {
        $productData = [];
        $price = 0;
        foreach ($products as $product) {
            $count = (empty($product['quantity'])) ? 1 : $product['quantity'];
            $productPrice = $product['is_sales'] === 0
                ? $product['price']
                : $product['price_with_sales'];
            $price += $productPrice * $count;

            $productData["Товар"][] = [
                "Ид" =>  $product['id'],
                "Наименование" => $product['attr']['product_description']['name'],
                "БазоваяЕдиница" => [
                        'Код' => '796',
                        'НаименованиеПолное' => 'Штука',
                        'МеждународноеСокращение' => 'PCE'
                    ],
                "ЦенаЗаЕдиницу" => $productPrice,
                "Количество" => $count,
                "Сумма" => $productPrice * $count,
                "ЗначенияРеквизитов" => [
                    'ЗначениеРеквизита' => [
                        'Наименование' => 'ВидНоменклатуры',
                        'Значение' => 'Товар'
                    ]
                ]
            ];
        }

        return ['products' => $productData, "total" => $price];
    }
}
