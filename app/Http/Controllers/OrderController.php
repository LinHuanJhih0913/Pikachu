<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $data = Order::where('user_id', auth()->user()['id'])
            ->where('isPay', true)
            ->get();
        $totalPrice = Order::where('user_id', auth()->user()['id'])
            ->where('isPay', true)
            ->sum('price');
        return view('order.order', compact(['data', 'totalPrice']));
    }
}
