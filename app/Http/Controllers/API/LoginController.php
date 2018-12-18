<?php

namespace App\Http\Controllers\API;

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

        if (auth()->attempt($request->only(['email', 'password']))) {
            auth()->login($request->user());
        } else {
            return response()->json([
                'result' => 'fail',
                'message' => '帳號密碼錯誤'
            ]);
        }

        return response()->json([
            'result' => 'success',
            'data' => ''
        ]);
    }
}
