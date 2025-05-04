@extends('layouts.default')
@section('content')
<h1 class="text-2xl font-bold mb-2 text-gray-800">Selamat Datang di Aplikasi Voting</h1>
<p class="text-gray-600">Satu suara Anda menentukan masa depan. Voting kini lebih mudah dan aman.</p>

<form action="{{ route('otp.request') }}" method="post">
    @csrf
    <div class="w-1/3 mx-auto my-12">
        <div class="flex justify-center">
            {{-- if session error is set, change border color --}}
            <input type="text" name="ktp_number" class="flex-1 px-4 py-2 border border-gray-300 rounded-md mr-2 {{ session('error') ? 'border-red-500 border-2' : '' }}" placeholder="Masukkan NIK Anda">
            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md">Vote</button>
        </div>
        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-2 rounded-lg my-4 text-sm">
                {{ session('error') }}
            </div>
        @endif
        <small class="block m-2 text-left text-gray-600">Contoh: 3578000000000000</small>
    </div>
</form>
@stop
