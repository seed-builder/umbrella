<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePrices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('')->comment('名称');
            $table->decimal('deposit_cash')->default(0.0)->comment('保证金');
            $table->decimal('hire_price')->default(0.0)->comment('租金价格');
            $table->integer('hire_unit_hours')->default(1)->comment('单位(默认1小时)');
            $table->integer('hire_free_hours')->default(0)->comment('租借免费小时数');
            $table->integer('delay_seconds')->default(60)->comment('计费延时（秒）');
            $table->integer('hire_expire_hours')->default(0)->comment('租借逾期小时数(逾期则扣除保证金)');
			$table->timestamp('begin')->nullable()->comment('有效期开始日期');
			$table->timestamp('end')->nullable()->comment('有效期结束日期');
			$table->integer('is_default')->default(1)->comment('是否默认(1-是， 2-否)');
			$table->integer('status')->default(1)->comment('状态（1-启用， 2-禁用）');

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
        Schema::dropIfExists('prices');
    }
}
