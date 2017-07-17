<?php

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Umbrella;
use App\Models\Equipment;
use App\Models\Site;
use Illuminate\Support\Facades\DB;

class CustomerHireSeeder extends Seeder
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
        $umbrella_ids = Umbrella::all()->pluck('id')->toArray();
        $equ_ids = Equipment::all()->pluck('id')->toArray();
        $site_ids = Site::all()->pluck('id')->toArray();

        $data = [];
        for ($i = 0; $i < 100; $i++) {
            $hire_day = random_int(5,20);
            $data[] = [
                'customer_id' => $faker->randomElement($customer_ids),
                'umbrella_id' => $faker->randomElement($umbrella_ids),
                'hire_equipment_id' => $faker->randomElement($equ_ids),
                'hire_site_id' => $faker->randomElement($site_ids),
                'hire_at' => $faker->dateTime,
                'deposit_amt' => 0,
                'return_equipment_id' => $faker->randomElement($equ_ids),
                'return_site_id' => $faker->randomElement($site_ids),
                'return_at' => $faker->dateTime,
                'expire_day' => random_int(5,20),
                'expired_at' => $faker->dateTime,
                'hire_day' => $hire_day,
                'hire_amt' => $hire_day*0.5,
                'status' => $faker->randomElement([1,2,3]),
                'created_at' => date('Y-m-d H:i:s')
            ];
        }

        DB::table('customer_hires')->insert($data);
    }
}
