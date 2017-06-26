<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UmbrelladbTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
         * 客户
         */
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('mobile', 50)->unique()->nullable()->comment('手机号');
            $table->string('openid', 100)->unique()->nullable()->comment('微信openid');
            $table->string('nickname')->default('')->comment('微信昵称');
            $table->string('head_img_url')->default('')->comment('微信头像');
	        $table->string('password')->default('')->comment('密码');
	        $table->integer('login_time')->default(0);
	        $table->integer('gender')->nullable()->comment('性别(0-未知，1-男,2-女');
	        $table->timestamp('birth_day')->nullable()->comment('生日');
	        $table->string('address')->nullable()->comment('地址');
	        $table->string('remark')->nullable()->comment('备注');
	        $table->string('country')->nullable()->comment('国家');
	        $table->string('province')->nullable()->comment('省份');
	        $table->string('city')->nullable()->comment('城市');

	        $table->integer('creator_id')->default(0)->comment('创建用户id');
	        $table->integer('modifier_id')->default(0)->comment('修改用户id');
            $table->timestamps();
            $table->softDeletes();
        });

        /*
         * 客户资金账户
         */
        Schema::create('customer_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sn',100)->unique()->comment('账户号');
            $table->integer('customer_id')->comment('customers id');
            $table->decimal('balance_amt', 12, 2)->default("0.00")->comment('余额');
            $table->decimal('freeze_amt', 12, 2)->default("0.00")->comment('冻结金额');
	        $table->integer('creator_id')->default(0)->comment('创建用户id');
	        $table->integer('modifier_id')->default(0)->comment('修改用户id');
            $table->timestamps();
	        $table->softDeletes();
        });

	    /*
		 * 客户资金流水记录
		 */
	    Schema::create('customer_account_records', function (Blueprint $table) {
		    $table->increments('id');
		    $table->integer('customer_account_id')->comment('accounts id');
		    $table->integer('customer_id')->comment('customer id');
		    $table->decimal('amt', 12, 2)->default(0)->comment('流水金额');
		    $table->integer('type')->default(1)->comment('流水类型 1-充值（收入）， 2-押金充值， 3-押金支出， 4-押金退回（收入)， 5-租金支出， 6-提现支出');
		    $table->integer('status')->default(0)->comment('状态(1-未完成，2-已完成, 3-取消)');
		    $table->string('remark')->comment('备注');
		    $table->integer('creator_id')->default(0)->comment('创建用户id');
		    $table->integer('modifier_id')->default(0)->comment('修改用户id');
		    $table->timestamps();
		    $table->softDeletes();
	    });


        /*
         * 客户订单记录
         */
        Schema::create('customer_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sn',100)->unique()->unique()->comment('内部订单号 系统内部的订单号');
            $table->string('outer_order_sn',100)->nullable()->comment('外部订单号 支付宝|微信生成的订单号');
            $table->integer('customer_id')->comment('customer id');
            $table->integer('payment_channel')->default(1)->comment('支付渠道 1-微信支付 2-支付宝');
            $table->decimal('amt', 12, 2)->default(0)->comment('订单金额');
            $table->longText('remark')->comment('备注');
			$table->integer('status')->default(0)->comment('支付状态（1-未支付, 2-已支付, 3-支付失败）');
			$table->integer('type')->default(0)->comment('类型(1-账户充值, 2-押金支付');
			$table->integer('reference_id')->nullable()->comment('关联表id');
			$table->string('reference_type')->nullable()->comment('关联表类型');
	        $table->integer('creator_id')->default(0)->comment('创建用户id');
	        $table->integer('modifier_id')->default(0)->comment('修改用户id');
            $table->timestamps();
            $table->softDeletes();
        });

        /*
         * 提现纪录
         */
        Schema::create('customer_withdraws', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sn',100)->unique()->comment('内部单号 系统内部的单号');
            $table->string('outer_order_sn',100)->nullable()->comment('外部单号 微信生成的单号');
            $table->integer('customer_id')->comment('customer id');
            $table->integer('status')->comment('1-提现申请中 2-提现成功 3-提现失败' );
            $table->decimal('amt', 12, 2)->default(0)->comment('订单金额');
            $table->longText('remark')->comment('备注');
            $table->integer('creator_id')->default(0)->comment('创建用户id');
            $table->integer('modifier_id')->default(0)->comment('修改用户id');
            $table->timestamps();
            $table->softDeletes();
        });

        /*
         * 共享伞
         */
        Schema::create('umbrellas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sn')->unique()->default('')->comment('伞编号');
            $table->integer('equipment_id')->nullable()->comment('equipments id');
            $table->integer('site_id')->nullable()->comment('sites id');
            $table->integer('status')->default(1)->comment('状态 1-未发放 2-待借中 3-借出中 4-失效（超过还伞时间）');
            $table->string('name')->default('')->comment('伞名称');
            $table->string('model')->default('')->comment('型号');
            $table->string('color')->nullable()->default('')->comment('颜色');
            $table->string('logo')->default('')->comment('logo');
            $table->integer('price_id')->nullable()->comment('价格id');
	        $table->integer('creator_id')->default(0)->comment('创建用户id');
	        $table->integer('modifier_id')->default(0)->comment('修改用户id');
            $table->timestamps();
	        $table->softDeletes();
        });

        /*
         * 客户租用纪录
         */
        Schema::create('customer_hires', function (Blueprint $table) {
            $table->increments('id');
	        $table->integer('customer_id')->comment('customer id');
            $table->integer('umbrella_id')->comment('umbrellas id');

            $table->integer('hire_equipment_id')->comment('equipments id 借伞设备id');
            $table->integer('hire_site_id')->comment('sites id 借伞网点id');
            $table->timestamp('hire_at')->comment('借伞时间');
            $table->decimal('deposit_amt',12, 2)->default(0)->comment('缴纳的保证金');

            $table->integer('return_equipment_id')->comment('equipments id 还伞设备id');
            $table->integer('return_site_id')->comment('sites id 还伞网点id');
            $table->timestamp('return_at')->comment('还伞时间');

            $table->integer('expire_day')->default(15)->comment('有效期（天）');
            $table->timestamp('expired_at')->nullable()->comment('到期时间');
            $table->integer('hire_day')->default(0)->comment('租用时长');
            $table->decimal('hire_amt', 12, 2)->default('0.00')->comment('租借费用');
            $table->integer('status')->default(1)->comment('状态(1-租借中, 2-已完成, 3-逾期未归还 4-待支付租金)');

	        $table->integer('creator_id')->default(0)->comment('创建用户id');
	        $table->integer('modifier_id')->default(0)->comment('修改用户id');
            $table->timestamps();
	        $table->softDeletes();
        });

        /*
         * 设备
         */
        Schema::create('equipments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sn')->unique()->comment('设备编号');
            $table->integer('site_id')->comment('sites id');
            $table->integer('capacity')->default(50)->comment('容量（伞数量）');
            $table->integer('have')->default(0)->comment('当前还有数（伞数量）');
            $table->integer('type')->default(1)->comment('设备类型 1-伞机设备 2-手持设备');
            $table->string('ip')->nullable()->comment('ip');
            $table->integer('status')->default(0)->comment('状态（1-未启用, 2-启用, 3-系统故障）');
	        $table->integer('creator_id')->default(0)->comment('创建用户id');
	        $table->integer('modifier_id')->default(0)->comment('修改用户id');
            $table->timestamps();
	        $table->softDeletes();
        });

        /*
         * 设备日志
         */
        Schema::create('equipment_logs', function (Blueprint $table) {
            $table->increments('id');

            $table->string('api_name')->comment('模块名 （表名|请求接口名）');
            $table->string('code')->comment('报警返回码');
            $table->string('type')->comment('超时|异常');
            $table->longText('content')->comment('报警内容');
            $table->integer('equipment_id')->default(0)->comment('equipments id');
            $table->integer('site_id')->default(0)->comment('equipments id');

	        $table->integer('creator_id')->default(0)->comment('创建用户id');
	        $table->integer('modifier_id')->default(0)->comment('修改用户id');
            $table->timestamps();
	        $table->softDeletes();
        });

        /*
         * 设备维修
         */
        Schema::create('equipment_maintains', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('equipment_id')->default(0)->comment('equipments id');
            $table->integer('site_id')->default(0)->comment('equipments id');
            //$table->integer('engineer')->default(0)->comment('sys_users id'); //未来优化 平台增加维修人员端
            $table->string('engineer')->default('')->comment('维修人员');
            $table->longText('maintain_content')->comment('维修内容');

	        $table->integer('creator_id')->default(0)->comment('创建用户id');
	        $table->integer('modifier_id')->default(0)->comment('修改用户id');
            $table->timestamps();
	        $table->softDeletes();
        });

        /*
         * 网点
         */
        Schema::create('sites', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique()->default('')->comment('网点名');
            $table->string('province')->default('')->comment('省份');
            $table->string('city')->default('')->comment('城市');
            $table->string('district')->default('')->comment('区域');
            $table->string('address')->default('')->comment('详细地址');
            $table->string('longitude')->default('')->comment('经度');
            $table->string('latitude')->default('')->comment('纬度');
            $table->integer('type')->default(1)->comment('网点类别 1-设备网点 2-还伞网点');

	        $table->integer('creator_id')->default(0)->comment('创建用户id');
	        $table->integer('modifier_id')->default(0)->comment('修改用户id');
            $table->timestamps();
	        $table->softDeletes();
        });


        /*
         * 系统日志
         */
        Schema::create('sys_logs', function (Blueprint $table) {
            $table->increments('id');

            $table->string('module')->comment('模块名 （表名|请求接口名）');
            $table->string('action')->comment('操作');
            $table->longText('content')->comment('内容');
            $table->integer('status')->default(3)->comment('1-成功 2-失败 3-未知');

            $table->integer('creator_id')->default(0)->comment('创建用户id');
            $table->integer('modifier_id')->default(0)->comment('修改用户id');
            $table->timestamps();
	        $table->softDeletes();
        });

        /*
         * 借伞纪录视图
         */
        $view_customer_hires = <<<EOD
CREATE 
VIEW `view_customer_hire`AS 
SELECT 
customer_hires.id,
customer_hires.customer_id,
customer_hires.umbrella_id,
customer_hires.hire_equipment_id,
customer_hires.hire_site_id,
customer_hires.hire_at,
customer_hires.deposit_amt,
customer_hires.return_equipment_id,
customer_hires.return_site_id,
customer_hires.return_at,
customer_hires.expire_day,
customer_hires.expired_at,
customer_hires.hire_day,
customer_hires.hire_amt,
customer_hires.status,
customer_hires.created_at,
customer_hires.updated_at,
hire_equ.sn AS hire_equ_sn,
hire_site.name AS hire_site_name,
return_equ.sn AS return_equ_sn,
return_site.name AS return_site_name

FROM customer_hires
LEFT JOIN customers ON customers.id = customer_hires.customer_id
LEFT JOIN equipments AS hire_equ ON hire_equ.id = customer_hires.hire_equipment_id
LEFT JOIN sites AS hire_site ON hire_site.id = customer_hires.hire_site_id
LEFT JOIN equipments AS return_equ ON return_equ.id = customer_hires.return_equipment_id
LEFT JOIN sites AS return_site ON return_site.id = customer_hires.return_site_id ;


EOD;

        DB::statement($view_customer_hires);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
        Schema::dropIfExists('customer_accounts');
        Schema::dropIfExists('customer_account_records');
        Schema::dropIfExists('customer_payments');
        Schema::dropIfExists('customer_withdraws');
        Schema::dropIfExists('customer_hires');
        Schema::dropIfExists('umbrellas');
        Schema::dropIfExists('umbrella_hires');
        Schema::dropIfExists('equipments');
        Schema::dropIfExists('equipment_logs');
        Schema::dropIfExists('equipment_maintains');
	    Schema::dropIfExists('sites');
	    Schema::dropIfExists('sys_logs');
        DB::statement('drop view view_customer_hire');

    }

}
