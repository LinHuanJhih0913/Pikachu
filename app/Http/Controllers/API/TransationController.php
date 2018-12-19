<?php

namespace App\Http\Controllers\API;

use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransationController extends Controller
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
        $transaction = Transaction::where('user_id', $user->id)
            ->orderBy('updated_at', 'desc')
            ->get(['user_id', 'game_id', 'amount', 'updated_at']);
        return response()->json([
            'result' => 'success',
            'data' => $transaction
        ]);
    }
}
