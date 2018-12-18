<?php

namespace App\Http\Controllers\API;

use App\Achievement;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AchievementController extends Controller
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
            'data' => Achievement::where('user_id', $user->id)->get()
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'api_token' => 'required',
            'achieve_id' => 'required|numeric|min:1|max:29'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'result' => 'fail',
                'message' => $validator->errors()
            ]);
        }
        $user = User::where('api_token', $request['api_token'])->first();
        if ($user == null) {
            return response()->json([
                'result' => 'fail',
                'message' => 'api_token error'
            ]);
        }
        Achievement::create([
            'user_id' => $user->id,
            'achieve_id' => $request->achieve_id
        ]);
        return response()->json([
            'result' => 'success',
            'date' => ''
        ]);
    }
}
