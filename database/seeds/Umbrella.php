<?php

use Illuminate\Database\Seeder;

class Umbrella extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('zh_CN');
        $eq_ids = \App\Models\Equipment::all()->pluck('id')->toArray();
        $site_ids = \App\Models\Site::all()->pluck('id')->toArray();

        $data = [];
        for ($i=0;$i<100;$i++){
            $data[] = [
                'sn' => 'S'.$faker->date('YmdHis').$faker->lexify('???'),
                'equipment_id' => $faker->randomElement($eq_ids),
                'site_id' => $faker->randomElement($site_ids),
                'status' => $faker->randomElement([1,2,3,4]),
                'name' => $faker->lexify('测试伞 ???'),
                'color' => $faker->randomElement(['红','橙','黄','绿','蓝',]),
            ];
        }

        DB::table('umbrellas')->insert($data);
    }
}
