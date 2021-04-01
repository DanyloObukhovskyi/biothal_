<?php

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;


class PaymentMethodsSeeder extends Seeder
{


    public $methods = [
        [
            'name' => 'Оплата при получении',
            'type' => 'upon_receipt'
        ],
        [
            'name' => 'Оплата картой',
            'type' => 'card'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_methods')->truncate();

        foreach ($this->methods as $method) {
            $PaymentMethod = new PaymentMethod();
            $PaymentMethod->name = $method['name'];
            $PaymentMethod->type = $method['type'];

            $PaymentMethod->save();
        }
    }
}
