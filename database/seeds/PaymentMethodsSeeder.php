<?php

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;


class PaymentMethodsSeeder extends Seeder
{


    public $methods = [
        'При получении'
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
            $PaymentMethod->name = $method;

            $PaymentMethod->save();
        }
    }
}
