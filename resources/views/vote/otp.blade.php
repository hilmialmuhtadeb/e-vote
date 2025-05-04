@extends('layouts.default')
@section('content')
<div class="bg-white shadow-lg rounded-xl p-8 max-w-md w-full mx-auto">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-4">Verifikasi OTP</h2>
    <p class="text-gray-600 text-sm text-center mb-6">
        {{-- only show last 4 digits of phone number --}}
        Masukkan kode OTP yang telah dikirim ke nomor <strong> <span>08******{{ substr($user->phone_number, -4) }}</span></strong>
    </p>

    <table class="mb-4 table text-sm">
        <tr>
            <td class="text-left p-2">NIK</td>
            <td class="text-left p-2">: {{ $user->ktp_number }}</td>
        </tr>
        <tr>
            <td class="text-left p-2">Nama</td>
            <td class="text-left p-2">: {{ $user->name }}</td>
        </tr>
        <tr>
            <td class="text-left p-2">No. KTA</td>
            <td class="text-left p-2">: {{ $user->ktp_number }}</td>
        </tr>
    </table>

    <form method="POST" action="{{ route('otp.verify') }}">
        @csrf
        <div class="mb-4">
            <label for="otp" class="block text-sm font-medium text-gray-700 mb-1">Kode OTP</label>
            <input
                type="text"
                inputmode="numeric"
                id="otp"
                name="otp"
                maxlength="6"
                required
                autofocus
                class="w-full px-4 py-2 text-center border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 {{ session('error') ? 'border-red-500 border-2' : '' }}"
            >
        </div>

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-2 rounded-lg my-4 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <input type="hidden" name="user_id" value="{{ $user->id }}">

        <button type="submit"
            class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
            Verifikasi
        </button>
    </form>

    <div class="mt-4 text-center text-sm text-gray-500">
        Belum menerima OTP?
        <form action="{{ route('otp.resend') }}" method="POST" class="inline">
            @csrf
            <input type="hidden" name="phone" value="{{ $user->phone_number }}">
            <button type="submit" class="text-blue-600 hover:underline">Kirim Ulang</button>
        </form>
    </div>
</div>
@endsection
