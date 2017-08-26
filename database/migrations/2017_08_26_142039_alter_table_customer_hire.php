<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableCustomerHire extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_hires', function (Blueprint $table) {
            //
	        $table->integer("price_id")->default(0)->comment('价格id');
	        $table->decimal("hire_day")->default(0)->comment('租借天数')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_hires', function (Blueprint $table) {
            //
	        $table->dropColumn('price_id');
        });
    }
}
