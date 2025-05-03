<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">

    {{-- Navbar --}}
    <header class="w-full px-6 py-4 bg-white flex items-center">
        {{-- <nav class="space-x-4">
            <a href="/" class="text-gray-600 hover:text-blue-600 font-medium">Vote</a>
        </nav> --}}
        <p class="text-bold">Logo | Nama Organisasi</p>
    </header>

    <main class="flex-1 flex items-center justify-center text-center px-6">
        <div class="w-full">
            <div class="bg-white shadow-lg rounded-xl p-8 max-w-md w-full mx-auto">
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-4">Verifikasi OTP</h2>
                <p class="text-gray-600 text-sm text-center mb-6">
                    Masukkan kode OTP yang telah dikirim ke nomor <strong>{{ $phone ?? '08xxxxxxxxxx' }}</strong>
                </p>
        
                @if(session('error'))
                    <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
                        {{ session('error') }}
                    </div>
                @endif
        
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
                            class="w-full px-4 py-2 text-center border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>
        
                    {{-- <input type="hidden" name="phone" value="{{ $phone }}"> --}}
        
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                        Verifikasi
                    </button>
                </form>
        
                {{-- <div class="mt-4 text-center text-sm text-gray-500">
                    Belum menerima OTP?
                    <form action="{{ route('otp.resend') }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="phone" value="{{ $phone }}">
                        <button type="submit" class="text-blue-600 hover:underline">Kirim Ulang</button>
                    </form>
                </div> --}}
            </div>
        </div>
    </main>

</body>
</html>
