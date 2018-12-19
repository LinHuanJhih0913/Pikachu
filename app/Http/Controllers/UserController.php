<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();
        return view('profile/profile', compact('user'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);

        $user = User::where('id', $request->user()['id'])
            ->update([
                'name' => $request['name']
            ]);

        return redirect('/');
    }

    public function getBalance(Request $request)
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
            'data' => [
                'balance' => $user->balance
            ]
        ]);
    }
}
