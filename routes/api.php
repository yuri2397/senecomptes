<?php

use Carbon\Carbon;
use App\Models\Account;
use App\Models\Payment;
use App\Models\AccountItem;
use Illuminate\Http\Request;
use Illuminate\Notifications\Action;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;

Route::post('/pay-ipn',[UserController::class, 'ipn']);
Route::any('/test',[TestController::class, "index"]);


Route::any("/run", function()  {

   return Artisan::call("migrate"); 
});

Route::any("/w", function(Request $request){
    return response()->json(["ok"]);
});