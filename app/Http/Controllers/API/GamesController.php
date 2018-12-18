<?php

namespace App\Http\Controllers\API;

use App\Game;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GamesController extends Controller
{
    public function index()
    {
        return response()->json([
            'result' => 'success',
            'data' => Game::all()
        ]);
    }
}
