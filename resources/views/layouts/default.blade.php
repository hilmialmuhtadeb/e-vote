<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Voting Online</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">
            
    @if(session('error'))
        <div class="fixed top-8 right-8 z-50 bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
            {{ session('error') }}
        </div>
    @endif

    @if(session('message'))
        <div class="fixed top-8 right-8 z-50 bg-blue-100 text-blue-700 p-3 rounded mb-4 text-sm">
            {{ session('message') }}
        </div>
    @endif

    <header class="w-full px-6 py-4 bg-white flex items-center">
        {{-- <nav class="space-x-4">
            <a href="/" class="text-gray-600 hover:text-blue-600 font-medium">Vote</a>
        </nav> --}}
        <p class="text-bold">Logo | Nama Organisasi</p>
    </header>

    <main class="flex-1 flex items-center justify-center text-center px-6">
        <div class="w-full">
            @yield('content')
        </div>
    </main>

</body>
</html>
