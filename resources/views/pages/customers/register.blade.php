{{-- resources/views/pages/customer/register.blade.php --}}
@extends('layouts.layout')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white shadow p-6 rounded">
    <h2 class="text-2xl font-bold mb-4">Registrasi Customer</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ url('/customer/register') }}">
        @csrf
        <div class="mb-4">
            <label>Nama</label>
            <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label>Email</label>
            <input type="email" name="email" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label>Password</label>
            <input type="password" name="password" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="w-full border rounded px-3 py-2" required>
        </div>
        <button type="submit" class="w-full bg-green-600 text-white py-2 rounded">Daftar</button>
    </form>

    <p class="text-sm mt-4">Sudah punya akun? <a href="{{ route('customer.login') }}" class="text-blue-600">Login</a></p>
</div>
@endsection
