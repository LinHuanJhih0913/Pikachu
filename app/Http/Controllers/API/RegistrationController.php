<?php

namespace App\Http\Controllers\API;

use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|unique:users|email|max:255',
            'password' => 'required|confirmed'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'result' => 'fail',
                'message' => $validator->errors()
            ]);
        }

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);

        $user = User::where('email', $request['email'])->first();
        Transaction::create([
            'user_id' => $user->id,
            'game_id' => 5,
            'amount' => 500,
            'description' => '儲值'
        ]);
        return response()->json([
            'result' => 'success',
            'data' => '',
        ]);
    }
}
