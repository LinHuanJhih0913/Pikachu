<?php

namespace App\Http\Controllers\API;

use App\Play;
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

        Play::create([
            'user_id' => $user['id'],
            'game_id' => $request['game_id']
        ]);

        Play::achieve($user);

        return response()->json([
            'result' => 'success',
            'data' => [
                'count' => Play::where('user_id', $user->id)->count('id')
            ]
        ]);
    }
}
