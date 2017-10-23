<?php

namespace App\Console\Commands;

use App\Models\Equipment;
use App\Models\Message;
use Illuminate\Console\Command;

class CheckEquipmentHas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'equipment:has';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check equipment has umbrella number';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $this->info('begin equipment check');
        $danger_eqs = Equipment::where('status', 3)->where('have','<',5)->get();
        $this->info('total 【'.$danger_eqs->count().'】 equipments has less 5 umbrella');
        foreach ($danger_eqs as $danger_eq){
            $log = new Message([
                'category' => 1,
                'level' => 2,
                'title' => '【网点】'.$danger_eq->site->name.'【设备】'.$danger_eq->sn.'的伞量已不足五把，请尽快补充',
                'content' => '【网点】'.$danger_eq->site->name.'【设备】'.$danger_eq->sn.'的伞量已不足五把，请尽快补充',
            ]);
            $log->save();
        }
        $this->info('equipment check end !');
    }
}
