<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatTableMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category')->default(0)->comment('0-普通,1-设备');
            $table->integer('level')->default(4)->comment('0-CRITICAL,1-ERROR,2-WARNING,3-NOTICE,4-INFO');
            $table->integer('site_id')->default(0)->comment('site id');
            $table->integer('equipment_id')->default(0)->comment('设备Id');
            $table->integer('channel')->default(0)->comment('通道号');
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->integer('read')->default(0)->comment('是否已读( 0-未读， 1-已读)');

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
        Schema::dropIfExists('messages');
    }
}
