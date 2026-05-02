<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ARH | {{ $title ?? '' }}</title>

    {{-- Font  --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{ asset('img/logo/ARH.png') }}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- VITE Bootstrap --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- CSS Custom --}}
    @stack('css')

</head>
<body>
    @include('layouts.navbar')

    <div style="overflow-x: hidden;">
        @yield('content')
        @include('components.whatsapp')
    </div>

    @include('layouts.footer')

    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    @stack('js')
</body>
</html>