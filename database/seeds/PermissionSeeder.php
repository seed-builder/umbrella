<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->customers();
        $this->umbrella();
        $this->site();
        $this->equipment();
        $this->permission();
        $this->sys_log();
    }

    /*
     * 权限
     */
    public function permission(){
        $rs = \App\Models\Permission::create([
            'pid' => 0,
            'name' => 'user_permission_manage',
            'display_name' => '用户权限管理',
            'description' => '用户权限管理',
            'type' => 'm',
        ]);

        $permissions = [
            [
                'name' => 'user_index',
                'display_name' => '系统用户管理',
                'description' => '系统用户管理',
                'type' => 'm',
                'url' => '/admin/user',
            ],
            [
                'name' => 'role_index',
                'display_name' => '角色管理',
                'description' => '角色管理',
                'type' => 'm',
                'url' => '/admin/role',
            ],
            [
                'name' => 'permission_index',
                'display_name' => '权限管理',
                'description' => '权限管理',
                'type' => 'm',
                'url' => '/admin/permission',
            ],
        ];

        foreach ($permissions as $permission){
            $permission['pid'] = $rs->id;
            DB::table('permissions')->insert($permission);
        }
    }

    /*
     * 微信用户
     */
    public function customers(){
        $rs = \App\Models\Permission::create([
            'pid' => 0,
            'name' => 'customer',
            'display_name' => '微信用户管理',
            'description' => '微信用户管理',
            'type' => 'm',
        ]);

        $data = [
            [
                'name' => 'customer_index',
                'display_name' => '用户管理',
                'description' => '用户管理',
                'type' => 'm',
                'url' => '/admin/customer',
            ],
            [
                'name' => 'customer_account_index',
                'display_name' => '用户资金账户',
                'description' => '用户资金账户',
                'type' => 'm',
                'url' => '/admin/customer_account',
            ],
            [
                'name' => 'customer_account_record_index',
                'display_name' => '用户资金流水记录',
                'description' => '用户资金流水记录',
                'type' => 'm',
                'url' => '/admin/customer_account_record',
            ],
            [
                'name' => 'customer_payment_index',
                'display_name' => '用户支付记录',
                'description' => '用户支付记录',
                'type' => 'm',
                'url' => '/admin/customer_payment',
            ],
        ];

        foreach ($data as $d){
            $d['pid'] = $rs->id;
            DB::table('permissions')->insert($d);
        }
    }

    /*
     * 伞
     */
    public function umbrella(){
        $rs = \App\Models\Permission::create([
            'pid' => 0,
            'name' => 'umbrella',
            'display_name' => '共享伞管理',
            'description' => '共享伞管理',
            'type' => 'm',
        ]);

        $data = [
            [
                'name' => 'umbrella_index',
                'display_name' => '共享伞列表',
                'description' => '共享伞列表',
                'type' => 'm',
                'url' => '/admin/umbrella',
            ],
            [
                'name' => 'customer_hire_index',
                'display_name' => '租用纪录',
                'description' => '租用纪录',
                'type' => 'm',
                'url' => '/admin/customer_hire',
            ],
        ];

        foreach ($data as $d){
            $d['pid'] = $rs->id;
            DB::table('permissions')->insert($d);
        }
    }

    /*
     * 设备
     */
    public function equipment(){
        $rs = \App\Models\Permission::create([
            'pid' => 0,
            'name' => 'equipment',
            'display_name' => '设备管理',
            'description' => '设备管理',
            'type' => 'm',
        ]);

        $data = [
            [
                'name' => 'equipment_index',
                'display_name' => '设备信息管理',
                'description' => '设备信息管理',
                'type' => 'm',
                'url' => '/admin/equipment',
            ],
            [
                'name' => 'equipment_log_index',
                'display_name' => '设备日志',
                'description' => '设备日志',
                'type' => 'm',
                'url' => '/admin/equipment_log',
            ],
            [
                'name' => 'equipment_maintain_index',
                'display_name' => '设备维修纪录',
                'description' => '设备维修纪录',
                'type' => 'm',
                'url' => '/admin/equipment_maintain',
            ],
        ];

        foreach ($data as $d){
            $d['pid'] = $rs->id;
            DB::table('permissions')->insert($d);
        }
    }

    /*
     * 网点
     */
    public function site(){
        $rs = \App\Models\Permission::create([
            'pid' => 0,
            'name' => 'site',
            'display_name' => '网点管理',
            'description' => '网点管理',
            'type' => 'm',
        ]);

        $data = [
            [
                'name' => 'site_index',
                'display_name' => '网点信息管理',
                'description' => '网点信息管理',
                'type' => 'm',
                'url' => '/admin/site',
            ],
        ];

        foreach ($data as $d){
            $d['pid'] = $rs->id;
            DB::table('permissions')->insert($d);
        }
    }

    /*
     * 系统日志
     */
    public function sys_log(){
        $rs = \App\Models\Permission::create([
            'pid' => 0,
            'name' => 'sys_log',
            'display_name' => '系统日志',
            'description' => '系统日志',
            'type' => 'm',
        ]);

        $data = [
            [
                'name' => 'sys_log_index',
                'display_name' => '系统日志查询',
                'description' => '系统日志查询',
                'type' => 'm',
                'url' => '/admin/sys_log',
            ],
        ];

        foreach ($data as $d){
            $d['pid'] = $rs->id;
            DB::table('permissions')->insert($d);
        }
    }
}
