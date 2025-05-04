<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Models\Otp;
use App\Models\Vote;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function requestOtp(Request $request)
    {
        $user = User::where('ktp_number', $request->ktp_number)->first();

        if (!$user) {
            return back()->with('error', 'KTP tidak ditemukan. Pastikan nomor KTP Anda benar.');
        }
        
        if ($user->votes) {
            return back()->with('error', 'Anda sudah melakukan voting.');
        }

        if ($user->status !== 'active') {
            return back()->with('error', 'Akun Anda belum aktif.');
        }

        $otp = rand(100000, 999999);

        Otp::create([
            'user_id' => $user->id,
            'otp_code' => $otp,
            'expired_at' => now()->addMinutes(5),
        ]);

        logger("OTP untuk {$user->phone_number}: $otp");

        session(['otp_user_id' => $user->id]);

        return redirect(route('otp.input'))->with('message', 'Kode OTP telah dikirim.');
    }

    public function inputOtp()
    {
        $userId = session('otp_user_id');

        if (!$userId) {
            return redirect('/')->with('error', 'Sesi OTP tidak ditemukan. Silakan masukkan KTP Anda kembali.');
        }
    
        $user = User::find($userId);
    
        if (!$user) {
            return redirect('/')->with('error', 'User tidak ditemukan.');
        }

        if ($user->votes) {
            return redirect('/')->with('error', 'Anda sudah melakukan voting.');
        }

        if (session('otp_verified')) {
            return redirect(route('vote.submission'));
        }
    
        return view('vote.otp', compact('user'));
    }

    public function verifyOtp(Request $request)
    {
        // todo: otp verification
        $user = User::find($request->user_id);

        $otp = $user->otps()
            ->where('otp_code', $request->otp)
            ->where('expired_at', '>', now())
            ->where('verified', false)
            ->latest()
            ->first();

        if (!$otp) {
            return back()->with('error', 'OTP tidak valid atau sudah kedaluwarsa.');
        }

        $otp->update(['verified' => true]);

        session(['otp_verified' => true]);
        
        return redirect(route('vote.submission'))->with('message', 'Kode OTP telah diverifikasi.');
    }

    public function resendOtp()
    {
        return back()->with('message', 'Kode OTP telah dikirim ulang.');
    }

    public function submission()
    {
        $candidates = Candidate::all();
        $userId = session('otp_user_id');

        if (!$userId) {
            return redirect('/')->with('error', 'Sesi OTP tidak ditemukan. Silakan masukkan KTP Anda kembali.');
        }
    
        $user = User::find($userId);

        if (!$user) {
            return redirect('/')->with('error', 'KTP Anda tidak terdaftar. Mohon hubungi admin.');
        }

        if ($user->votes) {
            return redirect('/')->with('error', 'Anda sudah melakukan voting.');
        }
        
        return view('vote.submission', compact('candidates', 'user'));
    }

    public function submitVote(Request $request)
    {
        $request->validate([
            'candidate_id' => 'required',
            'user_id' => 'required',
        ]);

        $user = User::find($request->user_id);
    
        if (!$user) {
            return redirect('/')->with('error', 'User tidak ditemukan.');
        }

        if ($user->votes) {
            return back()->with('error', 'Anda sudah melakukan voting.');
        }

        $user->votes()->create([
            'candidate' => $request->candidate_id,
        ]);

        session()->forget(['otp_verified', 'otp_user_id']);

        return redirect(route('vote.success'))->with('message', 'Voting berhasil. Terima kasih!');
    }

    public function success()
    {
        return view('vote.success');
    }
}
