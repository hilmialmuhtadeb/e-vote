<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/vote', [VoteController::class, 'index'])->name('vote.index');
Route::post('/vote/request-otp', [VoteController::class, 'requestOtp'])->name('vote.otp');
Route::post('/vote/submit', [VoteController::class, 'submitVote'])->name('vote.submit');
