<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSysDics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
	    Schema::create('sys_dics', function (Blueprint $table) {
		    $table->increments('id');
		    $table->string('value')->comment('值');
		    $table->string('text')->comment('显示名称');
		    $table->string('category')->comment('大类');
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
        //
	    Schema::dropIfExists('sys_dics');
    }
}
