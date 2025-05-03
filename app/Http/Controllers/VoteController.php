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
            return back()->with('error', 'KTP tidak ditemukan.');
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

        return redirect(route('otp.input'))->with('message', 'Kode OTP telah dikirim.');
    }

    public function verifyOtp(Request $request)
    {
        // todo: otp verification
        
        return redirect('vote.submission');
    }

    public function inputOtp()
    {
        return view('vote.otp');
    }

    public function submission()
    {
        $candidates = Candidate::all();
        
        return view('vote.submission', compact('candidates'));
    }

    public function submitVote(Request $request)
    {
        $request->validate([
            'candidate' => 'required|string',
            'otp_code' => 'required',
        ]);

        $user = Auth::user();
        $otp = $user->otps()
            ->where('otp_code', $request->otp_code)
            ->where('expired_at', '>', now())
            ->where('verified', false)
            ->latest()
            ->first();

        if (!$otp) {
            return back()->with('error', 'OTP tidak valid atau sudah kedaluwarsa.');
        }

        if ($user->votes) {
            return back()->with('error', 'Anda sudah melakukan voting.');
        }

        $otp->update(['verified' => true]);
        $user->votes()->create([
            'candidate' => $request->candidate,
        ]);

        return back()->with('message', 'Voting berhasil. Terima kasih!');
    }
}
