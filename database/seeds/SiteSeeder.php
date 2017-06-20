<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('zh_CN');

        $data = [];
        for ($i=0;$i<100;$i++){
            $data[] = [
                'name' => $faker->lexify('测试网点 ????'),
                'address' => $faker->address,
                'type' => $faker->randomElement([1,2]),
            ];
        }

        DB::table('sites')->insert($data);
    }
}
