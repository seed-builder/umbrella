<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Customer;
use App\Models\CustomerAccount;

class CustomerAccountRecordSeeder extends Seeder
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
        $account_ids = CustomerAccount::all()->pluck('id')->toArray();

        $data = [];
        for ($i=0;$i<100;$i++){
            $data[] = [
                'customer_account_id' => $faker->randomElement($account_ids),
                'customer_id' => $faker->randomElement($customer_ids),
                'amt' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0.5, $max = 20),
                'type' => $faker->randomElement([1,2]),
                'status' => $faker->randomElement([1,2,3]),
                'remark' => $faker->lexify('测试备注 ???'),
            ];
        }

        DB::table('customer_account_records')->insert($data);
    }
}
