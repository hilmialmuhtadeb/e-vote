<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoteController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/request-otp', [VoteController::class, 'requestOtp'])->name('otp.request');
Route::post('/verify-otp', [VoteController::class, 'verifyOtp'])->name('otp.verify');
Route::get('/otp', [VoteController::class, 'inputOtp'])->name('otp.input');
Route::get('/vote', [VoteController::class, 'submission'])->name('vote.submission');
Route::post('/vote/submit', [VoteController::class, 'submitVote'])->name('vote.submit');
