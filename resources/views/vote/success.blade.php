@extends('layouts.default')

@section('content')
    <div class="w-full max-w-4xl bg-white rounded-lg shadow-lg p-8 mx-auto">
        <div class="text-center">
            <img src="{{ asset('images/success.png') }}" alt="Sukses" class="mx-auto" width="100">
            <div class="mt-8 mb-4">
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Terima Kasih Sudah Memilih</h1>
                <p class="text-gray-600">Suara Anda telah terkirim.</p>
            </div>
            <a href="/" class="block text-blue-600 px-6 py-2 rounded-lg underline">
                Kembali ke Beranda
            </a>
        </div>
    </div>
@endsection