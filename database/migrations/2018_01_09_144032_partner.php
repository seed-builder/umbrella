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
            $table->string('name')->unique()->comment('登陆账号');
            $table->string('password')->default('')->comment('密码');
            $table->string('full_name')->default('')->comment('经销商全称');
            $table->string('linkman')->default('')->comment('联系人');
            $table->string('mobile')->default('')->comment('手机号');
            $table->string('address')->default('')->comment('地址');
            $table->string('remember_token')->nullable()->comment('remember_token');
            $table->integer('status')->default(1)->comment('状态 1-启用 2-禁用');

            $table->timestamps();
        });

        /**
         * 设备*经销商
         */
        Schema::table('equipments', function (Blueprint $table) {
            $table->integer('partner_id')->default(0)->comment('经销商id');
        });

        /**
         * 设备*价格
         */
        Schema::table('equipments', function (Blueprint $table) {
            $table->integer('price_id')->default(0)->comment('价格id');
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
        Schema::table('equipments', function (Blueprint $table) {
            $table->dropColumn('partner_id');
        });
        Schema::table('prices', function (Blueprint $table) {
            $table->dropColumn('equipment_id');
        });
    }
}
