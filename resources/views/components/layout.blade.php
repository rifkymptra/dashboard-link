<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Jakarta+Sans:wght@400;700&display=swap">
    <title>Dashboard Link BPS Kota Solok</title>
</head>

<body class="bg-gray-100 font-sans antialiased">
    <div x-data="{ open: window.innerWidth >= 768 }">
        <x-header></x-header>


        <div @resize.window="open = window.innerWidth >= 768" @toggle-sidebar.window="open = !open" class="flex">
            <x-sidebar></x-sidebar>


            <!-- Content -->
            <div class="flex-1 p-4 bg-white pt-20">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>

</html>
