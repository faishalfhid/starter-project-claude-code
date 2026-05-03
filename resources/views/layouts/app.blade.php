<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TokoKita - @yield('title', 'Mini Katalog Produk')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900 min-h-screen">
    <nav class="bg-white border-b border-gray-200 px-6 py-4">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <a href="/" class="text-xl font-bold">TokoKita</a>
            <div class="flex gap-4">
                <a href="/" class="hover:text-blue-600">Beranda</a>
            </div>
        </div>
    </nav>
    <main class="max-w-6xl mx-auto px-6 py-8">
        @yield('content')
    </main>
</body>
</html>