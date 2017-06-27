<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Customer;

class CustomerAccountSeeder extends Seeder
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
        foreach ($customer_ids as $customer_id){
            $data[] = [
                'sn' => $faker->numerify('##############'),
                'customer_id' => $customer_id,
                'balance_amt' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 20, $max = 500),
                'deposit' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 20, $max = 100),
                'freeze_deposit' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 20, $max = 100),
                'creator_id' => $faker->randomElement($user_ids),
                'modifier_id' => $faker->randomElement($user_ids),
            ];
        }

        DB::table('customer_accounts')->insert($data);
    }
}
