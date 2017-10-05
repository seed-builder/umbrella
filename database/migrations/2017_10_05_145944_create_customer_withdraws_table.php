<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerWithdrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_withdraws', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('payment_id')->default(0)->comment('payment_id *customer_payments');
            $table->integer('customer_id')->default(0)->comment('customer_id *customers');
            $table->decimal('amt', 12, 2)->default("0.00")->comment('提现押金');
            $table->integer('status')->default(0)->comment('状态(1-已申请，2-已打款, 3-打款失败 )');
            $table->string('remark')->comment('备注');

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
        Schema::dropIfExists('customer_withdraws');
    }
}
