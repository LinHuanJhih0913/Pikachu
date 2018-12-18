<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Play extends Model
{
    protected $guarded = [];

    public static function achieve(User $user)
    {
        $count = static::where('user_id', $user->id)->count('id');

        if ($count >= 1) {
            if (!Achievement::where('user_id', $user->id)->where('achieve_id', 1)->first()) {
                Achievement::create([
                    'user_id' => $user->id,
                    'achieve_id' => 1
                ]);
            }
        }

        if ($count >= 10) {
            if (!Achievement::where('user_id', $user->id)->where('achieve_id', 2)->first()) {
                Achievement::create([
                    'user_id' => $user->id,
                    'achieve_id' => 2
                ]);
            }
        }

        if ($count >= 50) {
            if (!Achievement::where('user_id', $user->id)->where('achieve_id', 3)->first()) {
                Achievement::create([
                    'user_id' => $user->id,
                    'achieve_id' => 3
                ]);
            }
        }

        if ($count >= 100) {
            if (!Achievement::where('user_id', $user->id)->where('achieve_id', 4)->first()) {
                Achievement::create([
                    'user_id' => $user->id,
                    'achieve_id' => 4
                ]);
            }
        }

        if ($count >= 200) {
            if (!Achievement::where('user_id', $user->id)->where('achieve_id', 5)->first()) {
                Achievement::create([
                    'user_id' => $user->id,
                    'achieve_id' => 5
                ]);
            }
        }
    }
}
