<?php

use App\Http\Controllers\UserController;
use App\Models\Account;
use App\Models\AccountItem;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Notifications\Action;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::post('/pay-ipn',[UserController::class, 'ipn']);


Route::any("/run", function()  {

   return Artisan::call("migrate"); 
});

Route::any("/w", function(Request $request){
    return response()->json(["ok"]);
});