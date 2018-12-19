<?php

use Illuminate\Database\Seeder;

class ShopTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $item1 = ['神奇鬧鐘', '扣分盾牌', '加分神器', '識破眼鏡'];
        $item2 = ['造型0', '造型1', '造型2', '造型3', '造型4', '造型5', '造型6', '造型7', '造型8', '造型9'];
        $item3 = ['蝴蝶結', '帽子', '氣球', '墨鏡', '小羊', '大樹', '房子', '蝸牛', '鳥', '牛'];
        for ($i = 0; $i < count($item1); $i++) {
            \Illuminate\Support\Facades\DB::table('shop_lists')->insert([
                'game_id' => 2,
                'item_id' => $i,
                'name' => $item1[$i]
            ]);
        }
        for ($i = 0; $i < count($item2); $i++) {
            \Illuminate\Support\Facades\DB::table('shop_lists')->insert([
                'game_id' => 3,
                'item_id' => $i,
                'name' => $item2[$i]
            ]);
        }
        for ($i = 0; $i < count($item3); $i++) {
            \Illuminate\Support\Facades\DB::table('shop_lists')->insert([
                'game_id' => 4,
                'item_id' => $i,
                'name' => $item3[$i]
            ]);
        }
    }
}
