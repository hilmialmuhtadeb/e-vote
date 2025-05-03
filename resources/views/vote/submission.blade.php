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
            <div class="w-full max-w-4xl bg-white rounded-lg shadow-lg p-8 mx-auto">
                <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Silakan Pilih Kandidat Anda</h1>
        
                <form method="POST" action="{{ route('vote.submit') }}">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach ($candidates as $candidate)
                            <label class="cursor-pointer group relative border rounded-xl overflow-hidden shadow hover:shadow-md transition">
                                <input type="radio" name="candidate_id" value="{{ $candidate->id }}" class="hidden peer" required>
        
                                {{-- <img src="{{ asset('storage/' . $candidate->photo) }}" alt="{{ $candidate->name }}" class="w-full h-48 object-cover"> --}}
                                <img src="{{ $candidate->photo }}" alt="{{ $candidate->name }}" class="w-full h-48 object-cover">
        
                                <div class="p-4 text-center bg-white">
                                    <h2 class="text-lg font-semibold text-gray-800 group-hover:text-blue-600">{{ $candidate->name }}</h2>
                                </div>
        
                                <div class="absolute inset-0 bg-blue-500 bg-opacity-20 opacity-0 peer-checked:opacity-100 transition"></div>
                            </label>
                        @endforeach
                    </div>
        
                    <div class="mt-8 text-center">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                            Kirim Suara
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

</body>
</html>
