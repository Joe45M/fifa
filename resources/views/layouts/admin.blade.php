<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css'])
</head>
<body class="font-sans antialiased">

<style>
    [x-cloak] {
        display: none;
    }
</style>

<div class="min-h-screen bg-gray-300">
    <livewire:layout.navigation />

    <!-- Page Heading -->


    <!-- Page Content -->
    <main>

        <livewire:toast></livewire:toast>

        <div class="container mx-auto">
            <div class="lg:grid-cols-10 gap-10 grid pt-10">
                <nav class="lg:col-span-3">
                    <x-card>
                        <a wire:navigate class="mb-3 block link" href="{{ route('admin.leagues') }}">Leagues</a>
                        <a wire:navigate class="mb-3 block link" href="{{ route('admin.clubs') }}">Clubs</a>
                    </x-card>
                </nav>

                <div class="lg:col-span-7">

                    @if (isset($actions))
                        <header class="bg-white mb-3 p-3 rounded-md flex shadow">
                            {{ $actions }}
                        </header>
                    @endif

                    {{ $slot }}
                </div>

            </div>
        </div>
    </main>
    @filamentStyles
    @filamentScripts
    @vite(['resources/js/app.js'])
</div>
</body>
</html>
