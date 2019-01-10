<?php

namespace App\Http\Controllers;

use App\Http\Controllers\sdk\SDKAdapter;
use App\Order;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function create()
    {
        $data = Order::where('user_id', auth()->user()['id'])
            ->where('isPay', true)
            ->get();
        return view('payment.pay', compact(['data']));
    }

    public function store(Request $request)
    {
        $sdk = new SDKAdapter(
            'http://35.221.242.75/',
            $request['price'],
            "good good eat",
            $request['tradeNo'],
            $request['tradeDate'],
            $request->user()['id']
        );
        $sdk->addItem([
            'Name' => "donate",
            'Price' => (int)$request['price'],
            'Currency' => "元",
            'Quantity' => (int)"1",
            'URL' => "dedwed"
        ]);
        Order::create([
            'user_id' => $request->user()['id'],
            'tradeNo' => $request['tradeNo'],
            'tradeDate' => $request['tradeDate'],
            'price' => $request['price']
        ]);
        $sdk->checkout();
    }

    public function returnurl(Request $request)
    {
        Log::info($request);
        $url = "HashKey=5294y06JbISpM5x9&MerchantID={$request['MerchantID']}&MerchantTradeNo={$request['MerchantTradeNo']}&PayAmt={$request['PayAmt']}&PaymentDate={$request['PaymentDate']}&PaymentType={$request['PaymentType']}&PaymentTypeChargeFee={$request['PaymentTypeChargeFee']}&RedeemAmt={$request['RedeemAmt']}&RtnCode={$request['RtnCode']}&RtnMsg={$request['RtnMsg']}&SimulatePaid={$request['SimulatePaid']}&TradeAmt={$request['TradeAmt']}&TradeDate={$request['TradeDate']}&TradeNo={$request['TradeNo']}&HashIV=v77hoKGq4kWxNNIS";

        if ($request['CheckMacValue'] == $this->checkMac($url)) {
            Log::info("TRUE");
            Order::where('tradeNo', $request['MerchantTradeNo'])
                ->update(['isPay' => true]);
            $user = Order::where('tradeNo', $request['MerchantTradeNo'])->first();
            $balance = User::where('id', $user->user_id)->first();
            User::where('id', $user->user_id)->update(['balance' => ($balance['balance'] + $user->price)]);
            Transaction::create([
                'user_id' => $user->user_id,
                'game_id' => 5,
                'amount' => $user->price,
                'description' => '儲值'
            ]);
        } else {
            Log::info("FALSE");
        }
    }

    private function checkMac($url)
    {
        Log::info("=====Start=====");
        Log::info("url: $url");
        $result = urlencode($url);
        Log::info("urlencode: $result");
        $result = strtolower($result);
        Log::info("strtolower: $result");
        $result = $this->strReplace($result);
        Log::info("strReplace: $result");
        $result = hash('sha256', $result);
        Log::info("hash: $result");
        $result = strtoupper($result);
        Log::info("strtoupper: $result");
        Log::info("=====End=====");
        return $result;
    }

    private function strReplace($str)
    {
        $result = str_replace('%2d', '-', $str);
        $result = str_replace('%5f', '_', $result);
        $result = str_replace('%2e', '.', $result);
        $result = str_replace('%21', '!', $result);
        $result = str_replace('%2a', '*', $result);
        $result = str_replace('%28', '(', $result);
        $result = str_replace('%29', ')', $result);
        $result = str_replace('%20', '+', $result);
        return $result;
    }
}
