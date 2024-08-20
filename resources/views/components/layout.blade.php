<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @include('sweetalert::alert')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">
    <title>DataLink Explorer</title>
    <link rel="shortcut icon" href="{{ asset('bps_logo.png') }}">
</head>

<body class="bg-gray-100 font-sans antialiased">
    <div x-data="{ open: window.innerWidth >= 768 }">
        <x-header></x-header>

        <div @resize.window="open = window.innerWidth >= 768" @toggle-sidebar.window="open = !open"
            class="flex bg-white">
            <x-sidebar x-show="open"></x-sidebar>

            <!-- Content -->
            <div class="flex-1 px-0 ml-4 bg-white pt-20">
                {{ $slot }}
            </div>
        </div>
    </div>
    {{-- <script src="{{ mix('js/app.js') }}"></script> --}}
</body>

</html>
