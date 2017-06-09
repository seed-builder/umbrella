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
	        $table->integer('gender')->nullable()->comment('性别(0-女,1-男，2-未知');
	        $table->timestamp('birth_day')->nullable()->comment('生日');
	        $table->string('address')->nullable()->comment('地址');
	        $table->string('remark')->nullable()->comment('备注');

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
		    $table->integer('type')->default(1)->comment('流水类型 1-充值（收入） 2-支出');
		    $table->integer('status')->default(0)->comment('状态(0-未完成，1-已完成, 2-取消)');
		    $table->string('remark')->comment('备注');
		    $table->integer('creator_id')->default(0)->comment('创建用户id');
		    $table->integer('modifier_id')->default(0)->comment('修改用户id');
		    $table->timestamps();
		    $table->softDeletes();
	    });


        /*
         * 客户支付记录
         */
        Schema::create('customer_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sn',100)->unique()->comment('内部订单号 系统内部的订单号');
            $table->string('outer_order_sn',100)->unique()->comment('外部订单号 支付宝|微信生成的订单号');
            $table->integer('customer_id')->comment('customer id');
            $table->integer('payment_channel')->default(1)->comment('支付渠道 1-微信支付 2-支付宝');
            $table->decimal('amt', 12, 2)->default(0)->comment('订单金额');
            $table->longText('remark')->comment('备注');
			$table->integer('status')->default(0)->comment('支付状态（0-未支付, 1-已支付, 2-支付失败）');
			$table->integer('type')->default(0)->comment('类型(1-定金支付, 2-租金支付, 3-账户充值支付');
			$table->integer('reference_id')->nullable()->comment('关联表id');
			$table->string('reference_type')->nullable()->comment('关联表类型');
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
            $table->integer('equipment_id')->comment('equipments id');
            $table->integer('site_id')->comment('sites id');
            $table->integer('status')->default(1)->comment('状态 1-未发放 2-待借中 3-借出中 4-失效（超过还伞时间）');
            $table->string('name')->default('')->comment('伞名称');
            $table->string('color')->default('')->comment('颜色');
            $table->string('logo')->default('')->comment('logo');
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
            $table->decimal('margin_amt',12, 2)->default(0)->comment('缴纳的保证金');

            $table->integer('return_equipment_id')->comment('equipments id 还伞设备id');
            $table->integer('return_site_id')->comment('sites id 还伞网点id');
            $table->timestamp('return_at')->comment('还伞时间');

            $table->integer('expire_day')->default(15)->comment('有效期（天）');
            $table->timestamp('expired_at')->nullable()->comment('到期时间');
            $table->integer('hire_day')->default(0)->comment('租用时长');
            $table->decimal('hire_amt', 12, 2)->default('0.00')->comment('租借费用');
            $table->integer('status')->default(1)->comment('状态(1-正常出租, 2-按时归还, 3-逾期未归还)');

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
            $table->integer('status')->default(0)->comment('状态（0-未启用, 1-启用, 2-系统故障）');
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

            $table->integer('creator_id')->default(0)->comment('创建用户id');
            $table->integer('modifier_id')->default(0)->comment('修改用户id');
            $table->timestamps();
	        $table->softDeletes();
        });



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
        Schema::dropIfExists('customer_hires');
        Schema::dropIfExists('umbrellas');
        Schema::dropIfExists('umbrella_hires');
        Schema::dropIfExists('equipments');
        Schema::dropIfExists('equipment_logs');
        Schema::dropIfExists('equipment_maintains');
	    Schema::dropIfExists('sites');
	    Schema::dropIfExists('sys_logs');

    }

}
