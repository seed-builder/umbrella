<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class InitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $c = User::where('name', 'admin')->count();
	    if($c == 0) {
		    User::create([
			    'name' => 'admin',
			    'nick_name' => 'admin',
			    'password' => bcrypt('888888'),
		    ]);
	    }

	    $r = Role::where('name', 'administrator')->count();
	    if($r == 0){
	    	Role::create([
	    		'name' => 'administrator',
	    		'display_name' => '超级管理员',
	    		'description' => '超级管理员',
 		    ]);
	    }
    }
}
