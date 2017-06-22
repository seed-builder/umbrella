<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableCustomerAccountRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_account_records', function (Blueprint $table) {
            //
	        $table->integer('source_id')->nullable()->comment('来源单号');
	        $table->integer('source_type')->nullable()->comment('来源类型');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_account_records', function (Blueprint $table) {
            //
	        $table->dropColumn('source_id');
	        $table->dropColumn('source_type');
        });
    }
}
