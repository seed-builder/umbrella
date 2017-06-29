<?php

use Illuminate\Database\Seeder;

class EquipmentLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('zh_CN');
        $site_ids = \App\Models\Site::all()->pluck('id')->toArray();
        $ep_ids = \App\Models\Equipment::all()->pluck('id')->toArray();

        $data = [];
        for ($i=0;$i<100;$i++){
            $data[] = [
                'api_name' => $faker->url,
                'code' => $faker->randomElement([40001,40002,50001,40006,50003]),
                'type' => $faker->randomElement(['超时','异常']),
                'content' => '测试报警内容'.random_int(100,999),
                'equipment_id' => $faker->randomElement($ep_ids),
                'site_id' => $faker->randomElement($site_ids),
                'created_at' => $faker->dateTime,
            ];
        }

        DB::table('equipment_logs')->insert($data);
    }
}
