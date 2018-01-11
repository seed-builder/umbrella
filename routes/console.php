<?php

use App\Services\CodeBuilder;
use App\Services\CustomerHireService;
use App\Services\DbHelper;
use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('build-code {table} {model} {--templates=*}', function ($table, $model, $templates=['common','datatables']) {
	$this->comment('begin build code command...');
	$db = new DbHelper();
	$columns = $db->getColumns($table);
	//var_dump($templates);
	$builder = new CodeBuilder($model, $table, $columns);
	$builder->createFiles( $templates );
	$this->comment('end build code command...');
})->describe('build code command!');

Artisan::command('chs', function () {
    $customerHireService = new CustomerHireService;
    $customerHireService->due();
    $this->comment('complete!');
})->describe(' CustomerHireService due');

Artisan::command('generate-channels', function () {
    $equipments = \App\Models\Equipment::all();
    foreach ($equipments as $equipment){
        if($equipment->equipment_channels->count() == 0){
            for ($i = 1; $i <= $equipment->channels; $i ++)
            \App\Models\EquipmentChannel::create([
                'equipment_id' => $equipment->id,
                'num' => $i
            ]);
        }
    }
})->describe(' generate equipment channels');
