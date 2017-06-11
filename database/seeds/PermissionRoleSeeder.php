<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Permission;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pers = Permission::all();

        foreach ($pers as $per){
            DB::table('permission_role')->insert([
                'permission_id' => $per->id,
                'role_id' => 1,
            ]);
        }

    }
}
