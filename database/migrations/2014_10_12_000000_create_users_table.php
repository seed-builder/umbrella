<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('email')->nullable();
            $table->string('nick_name')->nullable();
            $table->string('password');
            $table->integer('login_time')->default(0);
            $table->integer('gender')->nullable()->comment('性别(0-女,1-男，2-未知');
            $table->timestamp('birth_day')->nullable()->comment('生日');
            $table->string('tel')->nullable()->comment('联系电话');
            $table->string('address')->nullable()->comment('地址');
            $table->string('remark')->nullable()->comment('备注');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
