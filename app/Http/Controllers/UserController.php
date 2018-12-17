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

        return redirect('/u/' . $request->user()['id']);
    }
}
