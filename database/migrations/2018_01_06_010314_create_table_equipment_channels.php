<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEquipmentChannels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment_channels', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->integer('equipment_id')->comment('设备id');
            $table->tinyInteger('num')->default(1)->comment('伞道编号');
            $table->tinyInteger('lock_status')->default(0)->comment('通道锁状态(0-未知, 1-通道忙, 2-通讯超时, 160-通道超时, 161-中间,162-借伞,163-还伞)');
            $table->tinyInteger('umbrellas')->default(0)->comment('伞数量');
            $table->boolean('valid')->default(false)->comment('是否有效');
            $table->tinyInteger('rescue_times')->default(0)->comment('检测次数');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('equipments', function (Blueprint $table) {
            //
            $table->string("server_ip")->default('')->comment('服务端ip');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipment_channels');
        Schema::table('equipments', function (Blueprint $table) {
            //
            $table->dropColumn("server_ip");
        });
    }
}
