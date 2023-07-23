<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Utils\PayTech;
use Illuminate\Support\Facades\URL;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::post('/profile/new-pin', [UserController::class, 'newProfile'])->name('new-pin');
Route::get('/new-account', [UserController::class, 'newAccount'])->name('new-account');
Route::post('/new-account', [UserController::class, 'newAccountPost'])->name('new-account-post');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'register'], function() {
    Route::get('',[RegisterController::class, 'create'] )->name('register');
    Route::post('',[RegisterController::class, 'store'] );
});

Route::group(['prefix' => 'login'], function() {
    Route::get('',[LoginController::class, 'create'] )->name('login');
    Route::post('',[LoginController::class, 'store'] );
});

Route::get('new-account-admin', [UserController::class, 'newAccountAdmin'])->name('new-account-admin');
Route::post('new-account-admin', [UserController::class, 'newAccountAdminPost'])->name('new-account-post-admin');
Route::get('users', [UserController::class, 'users'])->name('users');
Route::get('update-user/{id}', [UserController::class, 'updateUser'])->name('update-user');
Route::post('update-user', [UserController::class, 'updateUserPost'])->name('update-user-post');
Route::get('dayly-check', [UserController::class, 'daylyCheck'])->name('dayly-check');

Route::view("pay-success", 'pay-success');
Route::view("pay-cancel", 'pay-cancel');