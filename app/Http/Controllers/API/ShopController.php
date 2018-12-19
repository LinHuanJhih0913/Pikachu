<?php

namespace App\Http\Controllers\API;

use App\Shop;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
    public function index(Request $request)
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

        $items = Shop::where('game_id', $request['game_id'])->get(['game_id', 'item_id']);
        return response()->json([
            'result' => 'success',
            'data' => [
                'items' => $items
            ]
        ]);
    }

    public function store(Request $request)
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
        if (Shop::where('game_id', $request['game_id'])->where('item_id', $request['item_id'])->count('id') != 1) {
            Shop::create([
                'game_id' => $request['game_id'],
                'item_id' => $request['item_id']
            ]);
        }
        return response()->json([
            'result' => 'success',
            'data' => ''
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
