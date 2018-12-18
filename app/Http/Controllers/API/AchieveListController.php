<?php

namespace App\Http\Controllers\API;

use App\AchieveList;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AchieveListController extends Controller
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
        return response()->json([
            'result' => 'success',
            'data' => AchieveList::all()
        ]);
    }
}
