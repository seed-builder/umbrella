<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
	    $this->call(UserSeeder::class);
	    $this->call(CustomerSeeder::class);
	    $this->call(CustomerAccountSeeder::class);
	    $this->call(CustomerAccountRecordSeeder::class);
	    $this->call(CustomerPayment::class);
	    $this->call(SiteSeeder::class);
	    $this->call(EquipmentSeeder::class);
	    $this->call(Umbrella::class);
	    $this->call(CustomerHireSeeder::class);
	    $this->call(PriceSeeder::class);
	    $this->call(EquipmentLogSeeder::class);
	    $this->call(EquipmentMaintainSeeder::class);
	    $this->call(CustomerWithdrawSeeder::class);

	    $this->call(PermissionSeeder::class);
	    $this->call(RoleSeeder::class);
	    $this->call(PermissionRoleSeeder::class);
	    $this->call(UserRoleSeeder::class);
    }
}
