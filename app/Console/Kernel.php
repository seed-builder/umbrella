<?php

namespace App\Console;

use App\Models\CustomerWithdraw;
use App\Models\Equipment;
use App\Models\Message;
use App\Services\CustomerHireService;
use App\Services\OrderService;
use App\Services\WithdrawService;
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
        'App\Console\Commands\CheckEquipmentHas',
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

        $schedule->call(function(WithdrawService $withdrawService){
            $withdrawService->remit();
        })->dailyAt('01:00');

        $schedule->call(function(OrderService $orderService){
            $orderService->close();
        })->dailyAt('04:00');

        $schedule->call(function(CustomerHireService $customerHireService){
            $customerHireService->due();
        })->everyFiveMinutes();

        $schedule->call(function(CustomerHireService $customerHireService){
            $customerHireService->dueTip();
        })->hourly();

//        $schedule->call(function(){
//            $danger_eqs = Equipment::where('have','<',5);
//            foreach ($danger_eqs as $danger_eq){
//                $log = new Message([
//                    'category' => 1,
//                    'level' => 2,
//                    'content' => '【网点】'.$danger_eq->site->name.'【设备】'.$danger_eq->sn.'的伞量已不足五把，请尽快补充',
//                ]);
//                $log->save();
//            }
//        })->everyFiveMinutes();
        $schedule->command('equipment:has')->everyFiveMinutes();



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
