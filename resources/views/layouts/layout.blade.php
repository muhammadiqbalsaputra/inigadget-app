<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Inigadget')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 text-gray-800">

    @include('layouts.navbar')

    <main class="py-8">
        <div class="max-w-7xl mx-auto px-6">
            @yield('content')
        </div>
    </main>

    @include('layouts.footer')

</body>

</html>
