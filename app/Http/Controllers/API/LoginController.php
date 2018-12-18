<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'result' => 'fail',
                'message' => $validator->errors()
            ]);
        }

        if (!auth()->attempt($request->only(['email', 'password']))) {
            return response()->json([
                'result' => 'fail',
                'message' => '帳號密碼錯誤'
            ]);
        }

        $user = User::where('email', $request->email)->first();
        if ($user['api_token'] == null) {
            $api_token = $user->genAPIToken();
            $user['api_token'] = $api_token;
            $user->update([
                'api_token' => $api_token
            ]);
        }
        return response()->json([
            'result' => 'success',
            'data' => [
                'name' => $user['name'],
                'blance' => '',
                'api_token' => $user['api_token'],
            ]
        ]);
    }

    public function autologin(Request $request)
    {
        $validator = Validator::make($request->all(), [
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
        return response()->json([
            'result' => 'success',
            'data' => [
                'name' => $user['name'],
                'blance' => '',
                'api_token' => $user['api_token'],
            ]
        ]);
    }
}
