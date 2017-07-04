<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquipmentSeeder extends Seeder
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

        $data = [];
        for ($i=0;$i<100;$i++){
            $type = $faker->randomElement([1,2]);
            $data[] = [
                'sn' => $type==1 ? 'E'.$faker->date('YmdHis').$faker->lexify('???') : 'M'.$faker->date('YmdHis').$faker->lexify('???'),
                'site_id' => $faker->randomElement($site_ids),
                'capacity' => $faker->randomElement([50,100,150,200]),
                'have' => $faker->randomNumber($nbDigits = NULL),
                'type' => $type,
                'ip' => $faker->ipv4,
                'status' => $faker->randomElement([1,2,3]),
            ];
        }

        DB::table('equipments')->insert($data);
    }
}
