<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSysColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
	    Schema::create('sys_columns', function (Blueprint $table) {
		    $table->increments('id');
		    $table->integer("sys_table_id");
		    $table->string('name')->comment('字段名称');
		    $table->string('display')->comment('显示名称');
		    $table->string('data_type')->comment('字段类型');
		    $table->integer("length")->default(0)->comment('字段长度');
		    $table->integer("decimal_scale")->default(0)->comment('小数点');
		    $table->integer('is_nullable')->default(0)->comment('是否为空');
		    $table->integer('is_autoincrement')->default(0)->comment('是否自增');
		    $table->string('key_type')->default('')->comment('键类型');
		    $table->string('default_value')->default('')->comment('默认值');
		    $table->string('comment')->default('')->comment('描述');
		    $table->string('ctrl_type')->default('')->comment('控件类型');
		    $table->string('ctrl_data_source')->default('')->comment('下拉选择控件数据源');
		    $table->string('ctrl_valid_rule')->default('')->comment('验证规则');
		    $table->integer('sort')->default(0)->comment('排序');
		    $table->integer('status')->default(0)->comment('状态（0-初始,1-被创建/更新,2-被修改）');
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
	    Schema::drop('sys_columns');
    }
}
