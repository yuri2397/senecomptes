<?php
namespace App\Providers;
use Illuminate\Support\Facades\Http;

class WhatsappService
{
    public function sendMessage($phone,$template_name = "bienvenue")
    {
        $url = env("WHATSAPP_URL");
        $body = ["messaging_product" => "whatsapp", "to" => "$phone", "type" => "template", "template" => ["name" => "$template_name", "language" => ["code" => "en_US"]]];
        $response = Http::withHeaders([
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer " . env("WHATSAPP_TOKEN")
        ])->post($url, $body);

        if($response->successful()){
            return true;
        }

        return false;
    }
}
