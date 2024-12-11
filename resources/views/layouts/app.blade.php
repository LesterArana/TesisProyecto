<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Forzar tema claro -->
    <meta name="color-scheme" content="light">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/7e868a7d53.js" crossorigin="anonymous"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Livewire Styles -->
    @livewireStyles
</head>
<body class="font-sans antialiased sm:overflow-auto bg-gradient-to-t from-neutral-200 to-slate-50 py-8"
      :class="{'overflow-hidden': open}"
      x-data="{open: false}">

@include("layouts.includes.admin.nav")
@include("layouts.includes.admin.aside")

<div class="min-h-screen flex flex-col bg-gradient-to-t from-neutral-200 to-slate-50">
    <div class="flex-grow p-4 sm:ml-64 bg-white rounded-lg">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg bg-white">
            {{ $slot }}
        </div>
    </div>
</div>

<div x-show="open"
     x-on:click="open = false"
     style="display:none"
     class="bg-gray-900/50 fixed inset-0 z-30 md:hidden">
</div>

@livewireScripts
@stack("scripts")
</body>
</html>
