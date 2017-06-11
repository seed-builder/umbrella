<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Customer;

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
        $user_ids = User::all()->pluck('id')->toArray();
        $customer_ids = Customer::all()->pluck('id')->toArray();

        $data = [];
        for ($i=0;$i<100;$i++){
            $data[] = [
                'sn' => $faker->numerify('##############'),
                'customer_account_id' => $faker->randomElement($customer_ids),
                'customer_id' => $faker->randomElement($customer_ids),
                'balance_amt' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 20, $max = 500),
                'freeze_amt' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 20, $max = 100),
                'creator_id' => $faker->randomElement($user_ids),
                'modifier_id' => $faker->randomElement($user_ids),
            ];
        }

        DB::table('customer_account_records')->insert($data);
    }
}
