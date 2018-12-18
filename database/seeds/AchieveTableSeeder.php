<?php

use Illuminate\Database\Seeder;

class AchieveTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name1 = ['試水溫', '新手', '駕輕就熟', '老手', '遊戲成癮者'];
        $name2 = ['低消', '半張小朋友', '好野人', '土豪'];
        $name3 = ['新手入門', '漸入佳境', '老鳥風範', '隱士高人'];
        $name4 = ['初次探險', '逐漸麻痺', '天不怕地不怕'];
        $name5 = ['snail', 'turtle', 'hermit_crab', 'seal', 'peacock', 'cat_from_bag', 'squirrel', 'little_bird', 'close_to_bird'];
        $name6 = ['新手起步', '漸入佳境', '值得敬佩', '毅力達人'];

        foreach ($name1 as $name) {
            \Illuminate\Support\Facades\DB::table('achieve_lists')->insert([
                'game_id' => 1,
                'name' => $name
            ]);
        }
        foreach ($name3 as $name) {
            \Illuminate\Support\Facades\DB::table('achieve_lists')->insert([
                'game_id' => 2,
                'name' => $name
            ]);
        }
        foreach ($name4 as $name) {
            \Illuminate\Support\Facades\DB::table('achieve_lists')->insert([
                'game_id' => 3,
                'name' => $name
            ]);
        }
        foreach ($name5 as $name) {
            \Illuminate\Support\Facades\DB::table('achieve_lists')->insert([
                'game_id' => 4,
                'name' => $name
            ]);
        }
    }
}
