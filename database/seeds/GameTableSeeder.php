<?php

use Illuminate\Database\Seeder;

class GameTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Common', 'Puzzle', 'Light On', 'Keep Sharking', 'Transaction'
        ];

        foreach ($names as $name) {
            \Illuminate\Support\Facades\DB::table('games')->insert([
                'name' => $name
            ]);
        }
    }
}
