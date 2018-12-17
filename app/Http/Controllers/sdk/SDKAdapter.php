<?php
/**
 * Created by PhpStorm.
 * User: jett
 * Date: 2018/12/17
 * Time: 下午 7:28
 */

namespace App\Http\Controllers\sdk;

include 'AllPay.Payment.Integration.php';

class SDKAdapter
{
    protected $obj;

    public function __construct($returnURL, $totalAmount, $descript, $tradeNo, $tradeDate)
    {
        $this->obj = new \AllInOne();
        //服務參數
        $this->obj->ServiceURL = "https://payment-stage.opay.tw/Cashier/AioCheckOut/V5";
        $this->obj->HashKey = '5294y06JbISpM5x9';
        $this->obj->HashIV = 'v77hoKGq4kWxNNIS';
        $this->obj->MerchantID = '2000132';
        $this->obj->EncryptType = \EncryptType::ENC_SHA256;

        //基本參數(請依系統規劃自行調整)
        $this->obj->Send['ReturnURL'] = $returnURL;
        $this->obj->Send['MerchantTradeNo'] = $tradeNo;
        $this->obj->Send['MerchantTradeDate'] = $tradeDate;
        $this->obj->Send['TotalAmount'] = $totalAmount;
        $this->obj->Send['TradeDesc'] = $descript;
        $this->obj->Send['ChoosePayment'] = \PaymentMethod::Credit;

        $this->obj->Send['ClientBackURL'] = "http://299c6236.ngrok.io/";
    }

    public function addItem($item = [])
    {
        array_push($this->obj->Send['Items'], $item);
    }

    public function checkout()
    {
        //產生訂單(auto submit至AllPay)
        $this->obj->CheckOut();
    }
}