@extends('layouts.default')
@section('content')
<div class="w-full max-w-4xl bg-white rounded-lg shadow-lg p-8 mx-auto">
    <div>
        <h1 class="text-lg text-left font-bold text-gray-800 mb-2">Informasi Pemilih</h1>
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
    </div>
    
    <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Silakan Pilih Kandidat Anda</h1>

    <form method="POST" action="{{ route('vote.submit') }}">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($candidates as $candidate)
                <label class="cursor-pointer group relative border rounded-xl overflow-hidden shadow hover:shadow-md transition">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
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
            <button
                type="button"
                onclick="openConfirmModal()"
                class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition"
            >
                Kirim Suara
            </button>
        
        </div>
    </form>

    <!-- Modal -->
    <div id="confirmModal" class="fixed inset-0 z-50 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Konfirmasi</h2>
            <p class="text-gray-600 mb-6">Apakah Anda yakin ingin mengirim suara Anda sekarang?</p>
            <div class="flex justify-center space-x-4">
                <button
                    onclick="closeConfirmModal()"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300"
                >
                    Batal
                </button>
                <button
                    onclick="submitVote()"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                >
                    Ya, Kirim
                </button>
            </div>
        </div>
    </div>

</div>

<script>
    function openConfirmModal() {
        const selected = document.querySelector('input[name="candidate_id"]:checked');
        if (!selected) {
            alert('Silakan pilih kandidat terlebih dahulu.');
            return;
        }
        document.getElementById('confirmModal').classList.remove('hidden');
        document.getElementById('confirmModal').classList.add('flex');
    }

    function closeConfirmModal() {
        document.getElementById('confirmModal').classList.add('hidden');
        document.getElementById('confirmModal').classList.remove('flex');
    }

    function submitVote() {
        document.querySelector('form').submit();
    }
</script>
@endsection
