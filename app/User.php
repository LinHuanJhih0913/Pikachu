<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function genAPIToken()
    {
        do {
            $api_token = $this->makeAPIToken();
        } while (User::where('api_token', $api_token)->first() instanceof User);

        return $api_token;
    }

    private function makeAPIToken()
    {
        return str_random(64);
    }
}
