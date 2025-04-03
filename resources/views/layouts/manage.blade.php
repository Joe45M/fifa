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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">

@php
   $route = request()->route()->getName();
@endphp


<div class="min-h-screen {{ $route != 'manage.submit' ? 'bg-gray-200' : '' }}">
    <livewire:layout.navigation />

    <livewire:toast></livewire:toast>
    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <main class="pt-5 {{ request()->route()->getName() }}">
        <div class="container mx-auto">
            <p class="mb-5 text-2xl font-bold {{ request()->route()->getName() === 'manage.submit' ? 'hidden' : '' }}">
                Manage {{ auth()->user()->currentContract->club->name }}
            </p>
            <div class="grid mb-5 gap-5 grid-cols-2 lg:grid-cols-7 {{ request()->route()->getName() === 'manage.submit' ? 'hidden' : '' }}">
                <a wire:navigate href="{{ route('manage.contracts') }}" class="font-bold uppercase text-sm bg-bg hover:bg-dark py-3 justify-center rounded-md flex items-center text-white text-white">
                    <div>
                        <div class="flex justify-center">
                        </div>
                        <div class="block text-center w-full">Contracts</div>
                    </div>
                </a>
                <a wire:navigate href="{{ route('manage.fixtures') }}" class="font-bold uppercase text-sm bg-bg hover:bg-dark py-3 justify-center rounded-md flex items-center text-white text-white">
                    <div>
                        <div class="flex justify-center">
                        </div>
                        <div class="block text-center w-full">Fixtures</div>
                    </div>
                </a>
                <a wire:navigate href="{{ route('manage.roster') }}" class="font-bold uppercase text-sm bg-bg hover:bg-dark py-3 justify-center rounded-md flex items-center text-white text-white">
                    <div>
                        <div class="flex justify-center">
                        </div>
                        <div class="block text-center w-full">Roster</div>
                    </div>
                </a>
                <a wire:navigate href="{{ route('manage.roster') }}" class="font-bold uppercase text-sm bg-bg hover:bg-dark py-3 justify-center rounded-md flex items-center text-white text-white">
                    <div>
                        <div class="flex justify-center">
                        </div>
                        <div class="block text-center w-full">Edit profile</div>
                    </div>
                </a>
            </div>

            <div>
                {{ $slot }}
            </div>
        </div>
    </main>
</div>

@filamentStyles
@filamentScripts
<script src="https://kit.fontawesome.com/57607a1fa7.js" crossorigin="anonymous"></script>
</body>
</html>
