<?php


namespace App\Traits;

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
        $dataQuery = $this->shoppingCart->where('order_import', 0);
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
            $xmlBody = [];
            $xmlBody["Ид"] = $order['id'];
            $xmlBody["Номер"] = $order['id'];
            $xmlBody["Дата"] = Carbon::parse($order['created_at'])->format('Y-m-d H:i:s');
            $xmlBody["ХозОперация"] = "Заказ товара";
            $xmlBody["Роль"] = "Продавец";
            $xmlBody["Валюта"] = "GRN";
            $xmlBody["Курс"] = "1";

            $counterparty = [];
            if (!empty($order['user_order_address'])) {
                $counterparty = $this->getCounterpartyData($order['user_order_address']);
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

            $xmlBody["Сумма"] = (!empty($products["total"]))
                ? $products["total"]
                : 0;

            //TODO: optimize this part
            $xmlBody["ЗначенияРеквизитов"]["ЗначениеРеквизита"][] = [
                "Наименование" => "Статус заказа",
                "Значение" => "В обработке",
            ];

            $xmlBody["ЗначенияРеквизитов"]["ЗначениеРеквизита"][] = [
                "Наименование" => "Способ доставки",
                "Значение" => "Бесплатная доставка",
            ];

            $xmlBody["ЗначенияРеквизитов"]["ЗначениеРеквизита"][] = [
                "Наименование" => "Способ оплаты",
                "Значение" => "Оплата при получении",
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
                    "Ид" => $userData['id'] . "#nomail@biothal.com.ua",
                    "Наименование" => $userData['LastName'] . " " . $userData['name'],
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
                                "Тип" => "ТелефонРабочий",
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
            $count = (empty($product['pivot']['count'])) ? 1 : $product['pivot']['count'];
            $productPrice = (empty($product['price_with_sale']))
                ? $product['price']
                : $product['price_with_sale'];
            $price += $productPrice * $count;

            $productData["Товар"][] = [
                "Ид" =>  $product['id'],
                "Наименование" => $product['name'],
                "ЦенаЗаЕдиницу" => $productPrice,
                "Количество" => $count,
                "Сумма" => $productPrice * $count
            ];
        }

        return ['products' => $productData, "total" => $price];
    }
}
