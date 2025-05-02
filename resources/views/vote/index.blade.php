<x-app-layout>
    <h2>Form Voting</h2>

    @if (session('message'))
        <div>{{ session('message') }}</div>
    @endif
    @if (session('error'))
        <div style="color:red">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('vote.otp') }}">
        @csrf
        <button type="submit">Kirim OTP ke nomor: {{ auth()->user()->phone_number }}</button>
    </form>

    <form method="POST" action="{{ route('vote.submit') }}">
        @csrf
        <input type="text" name="candidate" placeholder="Nama Kandidat" required>
        <input type="text" name="otp_code" placeholder="Kode OTP" required>
        <button type="submit">Vote</button>
    </form>
</x-app-layout>
