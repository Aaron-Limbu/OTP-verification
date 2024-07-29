<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OtpController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/verification',[OtpController::class,'index'])->name('api.verify');
Route::post('/verify',[OtpController::class,'generate'])->name('api.ver');
Route::get('/OTPCode',[OtpController::class,'code'])->name('api.code');
Route::post('/OTPv2c',[OtpController::class,'verify'])->name('api.vuntey');
Route::get('/welcome',function(){return view('dash');})->name('api.dash');
