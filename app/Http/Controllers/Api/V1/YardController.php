<?php


namespace App\Http\Controllers\Api\V1;


use App\Sheep;
use App\Yard;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class YardController
{

    public function fill_yard(Request $request)
    {

        $this->init_sheeps();

        $yards_with_sheeps = $this->get_yards_with_sheps();

        $result = [
            'yards' => $yards_with_sheeps,
            'days' => 0,
            'killed' => 0,
            'added' => 0,
            'moved' => 0,
        ];

        return response()->json($result);
    }

    public function refresh_yards()
    {
        $yards_with_sheeps = $this->get_yards_with_sheps();
        $days = DB::table('days')->count();
        $sheeps = DB::table('sheeps');
        $result = [
            'yards' => $yards_with_sheeps,
            'days' => $days,
            'added' => $days,
            'killed' => $sheeps->where(['is_killed' => true])->count(),
            'moved' => $sheeps->where(['is_moved' => true])->count(),
        ];

        return response()->json($result);
    }

    public function get_sheeps_by_yard_id(array $sheeps, int $id)
    {
        $result = array_keys(array_filter($sheeps, function ($v) use ($id) {
            return $v == $id;
        }));

        return $result;
    }

    public function get_yards_with_sheps()
    {
        $sheeps = Sheep::where(['is_killed' => false])->pluck('yard_id', 'name')->toArray();

        $yards_with_sheeps = [
            1 => $this->get_sheeps_by_yard_id($sheeps, 1),
            2 => $this->get_sheeps_by_yard_id($sheeps, 2),
            3 => $this->get_sheeps_by_yard_id($sheeps, 3),
            4 => $this->get_sheeps_by_yard_id($sheeps, 4),
        ];

        return $yards_with_sheeps;
    }

    public function init_sheeps()
    {
        DB::table('sheeps')->truncate();
        DB::table('days')->truncate();
        $yards = Yard::all()->pluck('order')->toArray();
        $counter = 1;
        $yards_order = [1, 2, 3, 4];
        while ($counter <= 10) {
            $yard_id = Arr::random($yards, 1)[0];
            DB::table('sheeps')->insert([
                'name' => sprintf('Овечка %s', $counter),
                'yard_id' => $yard_id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            $counter++;

            if (isset($yards)) {
                $key = array_search($yard_id, $yards_order);
                if (false !== $key) {
                    unset($yards_order[$key]);
                }
            }
        }
        // check that all yards has sheeps
        if (count($yards_order)) {
            $this->init_sheeps();
        }


    }
}
