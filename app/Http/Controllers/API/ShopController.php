<?php

namespace App\Http\Controllers\API;

use App\Shop;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
    public function index(Request $request, $game_id)
    {
        if (!$request->bearerToken()) {
            return response()->json([
                'result' => 'fail',
                'message' => 'no api in header'
            ]);
        }
        $user = User::where('api_token', $request->bearerToken())->first();
        if (!$user) {
            return response()->json([
                'result' => 'fail',
                'message' => 'api_token error'
            ]);
        }

        $items = Shop::where('user', $user->id)
            ->where('game_id', $game_id)
            ->get(['item_id']);
        return response()->json([
            'result' => 'success',
            'data' => $items
        ]);
    }

    public function store(Request $request)
    {
        Log::info("========================== /api/shop store");
        Log::info($request);
        $validator = Validator::make($request->all(), [
            'game_id' => 'required|numeric',
            'item_id' => 'required|numeric',
            'cost' => 'required|numeric',
            'api_token' => 'required|max:64'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'result' => 'fail',
                'message' => $validator->errors()
            ]);
        }
        $user = User::where('api_token', $request['api_token'])->first();
        if (!$user['api_token']) {
            return response()->json([
                'result' => 'fail',
                'message' => 'token error'
            ]);
        }
        if ($user->balance < 0) {
            return response()->json([
                'result' => 'fail',
                'message' => 'money not enough'
            ]);
        }
        if ($request['cost'] > $user->balance) {
            return response()->json([
                'result' => 'fail',
                'message' => 'money not enough'
            ]);
        }
        if ($request['game_id'] == 2) {
            Shop::create([
                'user_id' => $user->id,
                'game_id' => $request['game_id'],
                'item_id' => $request['item_id']
            ]);
            User::where('id', $user->id)->update([
                'balance' => ($user->balance - $request['cost'])
            ]);
            Transaction::create([
                'user_id' => $user->id,
                'game_id' => $request['game_id'],
                'amount' => -$request['cost'],
                'description' => '購買道具' . DB::table('shop_lists')
                        ->where('game_id', $request['game_id'])
                        ->where('item_id', $request['item_id'])
                        ->first()
                        ->name
            ]);
        }
        if (!Shop::where('game_id', $request['game_id'])->where('item_id', $request['item_id'])->first()) {
            Shop::create([
                'game_id' => $request['game_id'],
                'item_id' => $request['item_id']
            ]);
            User::where('id', $user->id)->update([
                'balance' => ($user->balance - $request['cost'])
            ]);
            Transaction::create([
                'user_id' => $user->id,
                'game_id' => $request['game_id'],
                'amount' => -$request['cost'],
                'description' => '購買道具' . DB::table('shop_lists')
                        ->where('game_id', $request['game_id'])
                        ->where('item_id', $request['item_id'])
                        ->first()
                        ->name
            ]);
        }
        return response()->json([
            'result' => 'success',
            'data' => [
                'balance' => User::where('api_token', $request['api_token'])->first()->balance
            ]
        ]);
    }

    public function destory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'game_id' => 'required|numeric',
            'item_id' => 'required|numeric',
            'api_token' => 'required|max:64'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'result' => 'fail',
                'message' => $validator->errors()
            ]);
        }
        $user = User::where('api_token', $request['api_token'])->first();
        if (!$user['api_token']) {
            return response()->json([
                'result' => 'fail',
                'message' => 'token error'
            ]);
        }
        $shop = Shop::where('game_id', $request['game_id'])->where('item_id', $request['item_id'])->first();
        if ($shop == null) {
            return response()->json([
                'result' => 'fail',
                'message' => 'not this item'
            ]);
        }
        $shop->delete();
        return response()->json([
            'result' => 'success',
            'data' => ''
        ]);
    }
}
