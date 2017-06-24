<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data[] = [
            'name' => '初始伞费规则',
            'deposit_cash' => 30,
            'hire_day_cash' => 0.5,
            'hire_free_days' => 7,
            'hire_expire_days' => 15,
            'begin' => date('Y-m-d H:i:s'),
            'end' => '2017-12-31 00:00:00',
            'is_default' => 1,
            'status' => 1,
        ];

        DB::table('prices')->insert($data);
    }
}
