<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddYardsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('yards')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('yards')->insert([
            'name' => 'Загон 1',
            'order' => 1,
        ]);
        DB::table('yards')->insert([
            'name' => 'Загон 2',
            'order' => 2,
        ]);
        DB::table('yards')->insert([
            'name' => 'Загон 3',
            'order' => 3,
        ]);
        DB::table('yards')->insert([
            'name' => 'Загон 4',
            'order' => 4,
        ]);

    }
}
