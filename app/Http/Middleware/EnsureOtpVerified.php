<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureOtpVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('otp_verified') || session('otp_verified') !== true) {
            return redirect('/')->with('error', 'Silakan verifikasi OTP terlebih dahulu.');
        }
        
        return $next($request);
    }
}
