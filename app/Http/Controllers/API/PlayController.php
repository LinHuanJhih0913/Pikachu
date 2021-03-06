<?php

namespace App\Http\Controllers\API;

use App\Play;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PlayController extends Controller
{
    public function play(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'api_token' => 'required',
            'game_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'result' => 'fail',
                'message' => $validator->errors()
            ]);
        }

        $user = User::where('api_token', $request['api_token'])->first();
        if (!$user) {
            return response()->json([
                'result' => 'fail',
                'message' => 'api_token error'
            ]);
        }

        if ($user->balance < 10) {
            return response()->json([
                'result' => 'fail',
                'message' => 'money not enough'
            ]);
        } else {
            Play::create([
                'user_id' => $user['id'],
                'game_id' => $request['game_id']
            ]);

            Play::achieve($user);

            User::where('api_token', $request['api_token'])->update([
                'balance' => ($user->balance - 10)
            ]);
            Transaction::create([
                'user_id' => $user->id,
                'game_id' => $request['game_id'],
                'amount' => -10,
                'description' => '玩遊戲'
            ]);
            return response()->json([
                'result' => 'success',
                'data' => [
                    'balance' => $user->balance - 10
                ]
            ]);
        }
    }
}
