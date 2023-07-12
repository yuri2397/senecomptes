<?php

namespace App\Utils;

use App\Models\PayementPending;
use App\Models\PaymentPending;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;

trait PayTech
{
    protected $price = 2500;
    protected $command_name = "Abonnement Netflix";
    protected $host = "https://sencomptes.com";
    protected $paytech_host = "https://paytech.sn";
    protected $api_key = "a22662c75275e4d6fce5ace7ed3cb611e911e556efc1806824c4854c9a54a99f";
    protected $secret_key = "459ea7b2c950cc05e01e17e45f5204c595e81603d23349537f15f04c15c6395c";

    protected function requestPayment($data, $client)
    {
        // return Http::withHeaders(array_merge([
        //     "API_KEY: {$this->api_key}",
        //     "API_SECRET: {$this->secret_key}"
        // ], [
        //     'Content-Type: application/x-www-form-urlencoded;charset=utf-8',
        //     'Content-Length: ' . mb_strlen(http_build_query($data))
        // ]))->post("https://paytech.sn/api/payment/request-payment", $data);
        $ch = curl_init("https://paytech.sn/api/payment/request-payment");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array_merge([
            "API_KEY: {$this->api_key}",
            "API_SECRET: {$this->secret_key}"
        ], [
            'Content-Type: application/x-www-form-urlencoded;charset=utf-8',
            'Content-Length: ' . mb_strlen(http_build_query($data))
        ]));

        $rawResponse = curl_exec($ch);
        $jsonResponse = json_decode($rawResponse, true);

        if ($jsonResponse != null && $jsonResponse['success'] === 1) {
            $padding = new PaymentPending();
            $padding->token = $jsonResponse['token'];
            $padding->user_id = $client->id;
            $padding->save();
            return redirect($jsonResponse['redirectUrl']);
        } else {
            toastr()->error("Merci de réessayer plus tart.", "Erreur de payement");
            back();
        }
    }

}