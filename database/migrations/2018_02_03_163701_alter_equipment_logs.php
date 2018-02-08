<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterEquipmentLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('equipment_logs', function (Blueprint $table) {
            $table->string('equipment_sn')->nullable()->comment('equipment sn');
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
        Schema::table('equipment_logs', function (Blueprint $table) {
            $table->dropColumn('equipment_sn');
        });
    }
}
