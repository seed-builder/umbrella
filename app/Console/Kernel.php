<?php

namespace App\Console;

use App\Models\Equipment;
use App\Models\EquipmentLog;
use App\Services\CustomerHireService;
use App\Services\OrderService;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        $schedule->call(function(OrderService $orderService){
            $orderService->close();
        })->dailyAt('04:00');

        $schedule->call(function(CustomerHireService $customerHireService){
            $customerHireService->due();
        })->everyFiveMinutes();

        $schedule->call(function(){
            $danger_eqs = Equipment::where('have','<',5);
            foreach ($danger_eqs as $danger_eq){
                $log = new EquipmentLog([
                    'code' => 50001,
                    'type' => '异常',
                    'content' => '【网点】'.$danger_eq->site->name.'【设备】'.$danger_eq->sn.'的伞量已不足五把，请尽快补充',
                ]);
                $log->save();
            }
        })->everyFiveMinutes();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
