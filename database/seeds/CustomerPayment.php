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
        for ($i=0;$i<100;$i++){
            $data[] = [
                'sn' => 'O'.$faker->date('YmdHis').$faker->lexify('???'),
                'outer_order_sn' => $faker->randomElement(['WX','ZF']).$faker->date('YmdHis').$faker->lexify('???'),
                'customer_id' => $faker->randomElement($customer_ids),
                'payment_channel' => $faker->randomElement([1,2]),
                'amt' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0.5, $max = 20),
                'remark' => $faker->lexify('测试备注 ???'),
                'status' => $faker->randomElement([1,2,3]),
                'type' => $faker->randomElement([1,2,3]),
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime,
            ];
        }

        DB::table('customer_payments')->insert($data);
    }
}
