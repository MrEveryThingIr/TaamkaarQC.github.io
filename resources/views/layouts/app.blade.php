<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- Fonts & Styles -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <!-- RTL Styling -->
    <style>
        body { direction: rtl; text-align: right; }
        .rtl .text-left { text-align: right; }
        .rtl .ml-auto { margin-right: auto; margin-left: 0; }
        .rtl .mr-auto { margin-left: auto; margin-right: 0; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100 rtl">
    <div class="flex flex-col min-h-screen">
        <header class="flex items-center justify-between p-4 text-white bg-gray-800">
            <div>
                <a href="{{ route('dashboard') }}" class="text-lg font-bold">Dashboard</a>
            </div>
            <div>
                <form method="GET" action="{{ route('dashboard.search') }}" class="flex items-center space-x-2">
                    <x-search-box />
                    <button type="submit" class="p-2 bg-blue-500 rounded">Search</button>
                </form>
            </div>
        </header>

        <div class="flex flex-1">
            <!-- Sidebar Partial -->
            @include('partials.sidebar')

            <!-- Main Content Area -->
            <main class="flex-1 p-6">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('modals')
    @livewireScripts
</body>
</html>
