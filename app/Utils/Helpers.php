<?php

use App\Models\Client;
use App\Models\Commercant;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;
use App\Providers\Services\OrangeSMSService;


if (!function_exists('normalizeTelephoneNumber')) {
    function normalizeTelephoneNumber(string $telephone): string
    {
        return str_replace([' ', '.', '-', '(', ')'], '', $telephone);
    }
}

if (!function_exists('formatPhoneNumber')) {
    function formatPhoneNumber(string $phone, bool $withPlus = true): string
    {
        $phone = normalizeTelephoneNumber($phone);
        if (!($plus = Str::is('+*', $phone)) && !($zero = Str::is('00*', $phone)) && Str::length($phone) == 9) {
            $phone  = ($withPlus ? '+' : '') . '221' . $phone;
        } else if ($plus && !$withPlus) {
            return Str::remove('+', $phone);
        } else if (($zero ?? false) && !$withPlus) {
            return Str::replaceFirst('00', '', $phone);
        }
        return $phone;
    }
}
