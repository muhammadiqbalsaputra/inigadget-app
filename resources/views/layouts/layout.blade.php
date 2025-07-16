<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Penting untuk responsive -->
    <title>@yield('title', 'Inigadget')</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('smartphone.png') }}" type="image/x-icon">

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

    {{-- Navbar --}}
    @include('layouts.navbar')

    {{-- Main content --}}
    <main class="flex-grow py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </main>

    {{-- Footer --}}
    @include('layouts.footer')

</body>

</html>
