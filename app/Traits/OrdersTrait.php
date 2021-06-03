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
                        'import_status' => 1
                    ]);
                    if($order['payment']['status'] !== 'success'){
                        continue;
                    }
                } else {
                    continue;
                }
            } else {
                Order::find($order['id'])->update([
                    'import_status' => 1
                ]);
            }
            $xmlBody = [];
            $xmlBody["Ид"] = $order['id'];
            $xmlBody["Номер"] = $order['id'];
            $xmlBody["Дата"] = date('Y-m-d', strtotime($order['created_at']));
            $xmlBody["Время"] = date('H:i:s', strtotime($order['created_at']));
            $xmlBody["Валюта"] = "GRN";
            $xmlBody["Курс"] = "1";
            $xmlBody["ХозОперация"] = "Заказ товара";
            $xmlBody["Роль"] = "Продавец";
            $xmlBody["Сумма"] = (!empty($order["total_sum"]))
                ? $order["total_sum"]
                : 0;
            $counterparty = [];
            if (!empty($order['user_address'])) {
                $counterparty = $this->getCounterpartyData($order['user_address']);
            }

            $xmlBody["Комментарий"] = (!empty($counterparty["comment"]))
                ? $counterparty["comment"]
                : "";

            $xmlBody["Скидка"] = "0";

            //$status = OrderStatuses::where('id', $order['order_status_id'])->first()->name;
            $orderType = $order['order_type_id'] === 1 ? 'Наложка' : 'Оплачен';

            $xmlBody["ЗначенияРеквизитов"]["ЗначениеРеквизита"][] = [
                "Наименование" => "Статус заказа",
                "Значение" => $orderType
            ];

            $xmlBody["ЗначенияРеквизитов"]["ЗначениеРеквизита"][] = [
                "Наименование" => "Почтовый индекс",
                "Значение" => 'Пусто'
            ];

            $xmlBody["ЗначенияРеквизитов"]["ЗначениеРеквизита"][] = [
                "Наименование" => "Способ доставки",
                "Значение" => 'Доставка в отделение Новой почты'
            ];

            $xmlBody["ЗначенияРеквизитов"]["ЗначениеРеквизита"][] = [
                "Наименование" => "Способ оплаты",
                "Значение" => $order['order_type']['title']
            ];

            $xmlBody["ЗначенияРеквизитов"]["ЗначениеРеквизита"][] = [
                "Наименование" => "Телефон",
                "Значение" => $order['user_address']['phone']
            ];

            $xmlBody["ЗначенияРеквизитов"]["ЗначениеРеквизита"][] = [
                "Наименование" => "Почта",
                "Значение" => $order['user_address']['email'] ?? 'nomail@biothal.com.ua'
            ];

            $xmlBody["ЗначенияРеквизитов"]["ЗначениеРеквизита"][] = [
                "Наименование" => "Адрес доставки",
                "Значение" => implode(", ", [ $order['user_address']['region'], $order['user_address']['department'] , $order['user_address']['cities']])
            ];

            $xmlBody["ЗначенияРеквизитов"]["ЗначениеРеквизита"][] = [
                "Наименование" => "Примечание к заказу",
                "Значение" => (!empty($counterparty["comment"]))
                    ? $counterparty["comment"]
                    : ""
            ];

            $xmlBody["Контрагенты"] = (!empty($counterparty["counterparty"]))
                ? $counterparty["counterparty"]
                : "";

            $products = '';
            if (!empty($order["products"])) {
                $products = $this->getProductsData($order["products"]);
            }

            $xmlBody["Товары"] = (!empty($products["products"]))
                ? $products["products"]
                : "";

            //TODO: optimize this part
            $status = OrderStatuses::where('id', $order['order_status_id'])->first()->name;
            $orderType = $order['order_type_id'] === 1 ? 'Наложка' : 'Оплачен';

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
            implode(", ", [ $userData['region'], $userData['department'] ,$userData['cities']]);

        return [
            "counterparty" => [
                "Контрагент" => [
                    "Ид" => $userData['id'],
                    "Наименование" => $userData['name'],
                    "Роль" => "Покупатель",
                    "Группа" => "Default",
                    "ПолноеНаименование" => $userData['LastName'] . " " . $userData['name'],
                    "Фамилия" => $userData['LastName'],
                    "Имя" => $userData['name'],
                    "Адрес" => [
                        "Представление" => implode(", ", [
                            $userData['region'],
                            $userData['department'],
                            $userData['cities']
                        ]),
                        "Контакты" => [
                            "Контакт" => [
                                'Тип' => 'Телефон рабочий',
                                'Значение' => $userData['phone']
                            ],
                            "Контакт" => [
                                'Тип' => 'Электронная почта',
                                'Значение' => $userData['email'] ?? 'nomail@biothal.com.ua'
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
                "БазоваяЕдиница" => 'шт',
                "ЦенаЗаЕдиницу" => $productPrice,
                "Количество" => $count,
                "Сумма" => $productPrice * $count,
            ];
        }

        return ['products' => $productData, "total" => $price];
    }
}
