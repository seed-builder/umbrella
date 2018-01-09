<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Partner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * 经销商基本信息
         */
        Schema::create('partners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('')->unique()->comment('登陆账号');
            $table->string('password')->default('')->comment('密码');
            $table->string('full_name')->default('')->unique()->comment('经销商全称');
            $table->string('linkman')->default('')->comment('联系人');
            $table->string('mobile')->default('')->comment('手机号');
            $table->string('address')->default('')->comment('地址');
            $table->integer('status')->default(1)->comment('状态 1-启用 2-禁用');

            $table->timestamps();
        });

        /**
         * 经销商*设备 关联表
         */
        Schema::create('partner_equipments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('equipment_id')->default(0)->comment('设备id');
            $table->integer('partner_id')->default(0)->comment('经销商id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partners');
        Schema::dropIfExists('partner_equipments');
    }
}
