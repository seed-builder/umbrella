<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class CustomerSeeder extends Seeder
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

        $customers = [];
        for ($i=0;$i<100;$i++){
            $customers[] = [
                'mobile' => $faker->phoneNumber,
                'openid' => $faker->bothify('wechat_##?##??'),
                'nickname' => $faker->bothify('微信昵称##?#?#'),
                'head_img_url' => 'imgurl',
                'login_time' => $faker->numerify('###'),
                'gender' => $faker->randomElement([0,1,2]),
                'birth_day' => $faker->date('Y-m-d'),
                'address' => $faker->address,
                'remark' => $faker->lexify('测试备注 ???'),
                'creator_id' => $faker->randomElement($user_ids),
                'modifier_id' => $faker->randomElement($user_ids),
            ];
        }

        DB::table('customers')->insert($customers);
    }
}
