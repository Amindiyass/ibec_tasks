<?php

namespace App\Console\Commands;

use App\Sheep;
use App\Yard;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class YardAddSheepCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'yard:sheep_add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $sheeps = Sheep::where(['is_killed' => false])->get();
        $last_sheep = Sheep::latest()->first();
        $yards = Yard::all()->pluck('order')->toArray();

        if (count($sheeps)) {
            $sheeps = $sheeps->pluck('yard_id', 'name')->toArray();
            $yard_id = Arr::random($yards, 1)[0];
            $sheeps = array_count_values($sheeps);
            if ($sheeps[$yard_id] > 1) {
                DB::table('sheeps')->insert([
                    'name' => sprintf('Овечка %s', $last_sheep->id + 1),
                    'yard_id' => $yard_id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            } else {
                $this->handle();
            }
        }

        $days = DB::table('days');
        $days->insert([
            'order' => $last_sheep->id + 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);


        if ($days->count() % 10 == 0) {
            $unluckySheep = Sheep::all()->random(1)->first();
            if (Sheep::where(['yard_id' => $unluckySheep->yard_id])->count() >= 1) {
                $unluckySheep->is_killed = true;
                $unluckySheep->save();
            }
        }

        $yard_with_one_sheep = (array_search(1, $sheeps));
        if (isset($yard_with_one_sheep)) {
            $random_sheep = Sheep::all()->random(1)->first();
            $random_sheep->yard_id = $yard_with_one_sheep;
            $random_sheep->is_moved += $random_sheep->is_moved + 1;
            $random_sheep->save();
        }
    }
}
