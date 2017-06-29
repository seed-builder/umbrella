<?php

use Illuminate\Database\Seeder;

class EquipmentMaintainSeeder extends Seeder
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
                'equipment_id' => $faker->randomElement($ep_ids),
                'site_id' => $faker->randomElement($site_ids),
                'engineer' => '测试维护人员'.random_int(100,999),
                'maintain_content' => '测试维护内容'.random_int(100,999),
                'created_at' => $faker->dateTime,
            ];
        }

        DB::table('equipment_maintains')->insert($data);
    }
}
