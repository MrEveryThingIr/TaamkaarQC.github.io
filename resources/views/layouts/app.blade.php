<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <script src="//unpkg.com/alpinejs" defer></script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles

        <!-- Additional RTL Styles (optional) -->
        <style>
            /* Example custom RTL styles */
            body {
                direction: rtl;
                text-align: right;
            }
            .rtl .text-left { text-align: right; }
            .rtl .ml-auto { margin-right: auto; margin-left: 0; }
            .rtl .mr-auto { margin-left: auto; margin-right: 0; }
            /* Add more custom adjustments if needed */
        </style>
    </head>
    <body class="font-sans antialiased rtl">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-right">
                        {{ $header }}
                    </div>
                </header>
            @endif



            <!-- Page Content -->
                                     <!-- Flash Message -->
        @if (session('success'))
        <div class="max-w-3xl mx-auto mt-4 px-4 sm:px-6 lg:px-8">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
    @endif
            <main>

                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
