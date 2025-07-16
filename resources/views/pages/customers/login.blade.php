{{-- resources/views/pages/customer/login.blade.php --}}
@extends('layouts.layout')

@section('content')
    <div class="max-w-md mx-auto mt-10 bg-white shadow p-6 rounded">
        <h2 class="text-2xl font-bold mb-4">Login Customer</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ url('/customer/login') }}">
            @csrf
            <div class="mb-4">
                <label>Email</label>
                <input type="email" name="email" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label>Password</label>
                <input type="password" name="password" class="w-full border rounded px-3 py-2" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded">Login</button>
        </form>

        <p class="text-sm mt-4">Belum punya akun? <a href="{{ route('customer.register') }}"
                class="text-blue-600">Daftar</a></p>
    </div>
@endsection
