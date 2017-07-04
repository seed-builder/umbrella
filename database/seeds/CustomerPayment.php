<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;

class CustomerPayment extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('zh_CN');
        $customer_ids = Customer::all()->pluck('id')->toArray();

        $data = [];
        $payment = new \App\Models\CustomerPayment();
        for ($i=0;$i<100;$i++){
            $type = $faker->randomElement([1,2,3,4,5,6]);
            $customer_id = $faker->randomElement($customer_ids);

            $data[] = [
                'sn' => $payment->snFlag($type).$faker->date('YmdHis').random_int(1000,9999),
                'outer_order_sn' => $faker->randomElement(['WX','ZF']).$faker->date('YmdHis').$faker->lexify('???'),
                'customer_id' => $customer_id,
                'payment_channel' => $faker->randomElement([1,2]),
                'amt' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0.5, $max = 20),
                'remark' => $faker->lexify('测试备注 ???'),
                'status' => $faker->randomElement([1,2,3]),
                'type' => $type,
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime,
            ];
        }

        DB::table('customer_payments')->insert($data);
    }
}
