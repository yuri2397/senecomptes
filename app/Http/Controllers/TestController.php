<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Utils\PayTech;
use Illuminate\Http\Request;

class TestController extends Controller
{
    use PayTech;
    public function index() {
        $data = [
            'item_price' => 2000,
            "currency"     => "xof",
            "ref_command" => "83748",
            'item_name' => "vente",
            'command_name' =>"test",
            "success_url"  =>  $this->host . '/pay-success',
            "ipn_url"      =>  $this->host . '/api/pay-ipn',
            "cancel_url"   =>  $this->host . '/pay-cancel',
            "custom_field" =>   ["b" => "bonjour"],
        ];

        $user = User::first();
        return $this->requestPayment($data, $user);
    }
}