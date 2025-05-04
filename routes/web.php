<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoteController;
use App\Http\Middleware\EnsureOtpVerified;

Route::get('/', function () {
    if (session('otp_verified')) {
        return redirect(route('vote.submission'));
    }
    
    return view('welcome');
});

Route::post('/request-otp', [VoteController::class, 'requestOtp'])->name('otp.request');
Route::get('/otp', [VoteController::class, 'inputOtp'])->name('otp.input');
Route::post('/verify-otp', [VoteController::class, 'verifyOtp'])->name('otp.verify');
Route::post('/resend-otp', [VoteController::class, 'resendOtp'])->name('otp.resend');
Route::get('/vote', [VoteController::class, 'submission'])->middleware(EnsureOtpVerified::class)->name('vote.submission');
Route::post('/vote/submit', [VoteController::class, 'submitVote'])->name('vote.submit');
Route::get('/vote/success', [VoteController::class, 'success'])->name('vote.success');