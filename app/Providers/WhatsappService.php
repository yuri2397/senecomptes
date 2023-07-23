<?php

use Illuminate\Support\Facades\Http;

class WhatsappService
{
    public function sendMessage($template_name = "hello_world", $lang = "en_US")
    {
        $url = env("WHATSAPP_URL");
        $body = ["messaging_product" => "whatsapp", "to" => "221765569300", "type" => "template", "template" => ["name" => "$template_name", "language" => ["code" => "$lang"]]];
        $response = Http::withHeaders([
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer " . env("WHATSAPP_TOKEN")
        ])->post($url);

        if($response->successful()){
            return true;
        }

        return false;
    }
}
