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

    {{-- Hero Section --}}
    <main class="flex-1 flex items-center justify-center text-center px-6">
        <div class="w-full">
            <h1 class="text-2xl font-bold mb-2 text-gray-800">Selamat Datang di Aplikasi Voting</h1>
            <p class="text-gray-600">Satu suara Anda menentukan masa depan. Voting kini lebih mudah dan aman.</p>

            <div class="w-1/3 mx-auto my-12">
                <div class="flex justify-center">
                    <input type="text" class="flex-1 px-4 py-2 border border-gray-300 rounded-md mr-2" placeholder="Masukkan NIK Anda">
                    <a href="/">
                        <p class="px-4 py-2 bg-blue-600 text-white rounded-md">Vote</p>
                    </a>
                </div>
                <small class="block m-2 text-left text-gray-600">Contoh: 3578000000000000</small>
            </div>
        </div>
    </main>

</body>
</html>
