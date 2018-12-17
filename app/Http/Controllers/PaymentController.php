<?php

namespace App\Http\Controllers;

use App\Http\Controllers\sdk\SDKAdapter;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function create()
    {
        return view('payment.pay');
    }

    public function store(Request $request)
    {
        $sdk = new SDKAdapter(
            'http://299c6236.ngrok.io/api/returnurl',
            $request['price'],
            "good good eat",
            $request['tradeNo'],
            $request['tradeDate']
        );
        $sdk->addItem([
            'Name' => "donate",
            'Price' => (int)$request['price'],
            'Currency' => "元",
            'Quantity' => (int)"1",
            'URL' => "dedwed"
        ]);
        $sdk->checkout();
    }

    public function returnurl(Request $request)
    {
        Log::info($request);
    }
}
