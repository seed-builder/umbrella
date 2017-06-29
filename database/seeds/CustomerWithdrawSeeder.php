<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;

class CustomerWithdrawSeeder extends Seeder
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
                'sn' => 'T'.$faker->date('YmdHis').$faker->lexify('???'),
                'outer_order_sn' => 'WT'.$faker->date('YmdHis').$faker->lexify('???'),
                'customer_id' => $faker->randomElement($customer_ids),
                'amt' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0.5, $max = 20),
                'remark' => $faker->lexify('测试备注 ???'),
                'status' => $faker->randomElement([1,2,3]),
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime,
            ];
        }

        DB::table('customer_withdraws')->insert($data);
    }
}
