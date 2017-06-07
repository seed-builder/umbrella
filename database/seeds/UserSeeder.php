<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
	    $c = User::where('name', 'admin')->count();
	    if($c == 0) {
		    User::create([
			    'name' => 'admin',
			    'nick_name' => 'admin',
			    'password' => bcrypt('888888'),
		    ]);
	    }
    }
}
