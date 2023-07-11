<?php

use App\Models\Account;
use App\Models\AccountItem;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Notifications\Action;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::post('/pay-ipn', function (Request $request) {

    if (true) {
        $ref_command = $request->input('ref_command');
        $payment = Payment::whereStatus(false)->whereReference($ref_command)->first();
        if ($payment) {
            $accountItem = AccountItem::find($payment->account_item_id);
            $accountItem->user_id = $payment->user_id;
            $accountItem->attach_at = now();
            $accountItem->limit_at = now()->addMonths($payment->nb_month);
            $payment->status = true;

            $payment->save();
            $accountItem->save();
            return response()->json(["message" => "OKAY"], 200);
        }

        return response()->json(["message" => "Payement n'existe pas"], 200);
    }

    return response()->json(["message" => "Cette requette ne vient pas de PayTech"], 422);
});


Route::any("/run", function()  {

   return Artisan::call("migrate"); 
});

Route::any("/w", function(Request $request){
    return response()->json(["ok"]);
});