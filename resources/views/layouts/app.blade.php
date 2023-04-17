<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME', 'Laravel') }}</title>
    {{-- LINK --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>

    @include('layouts.partials._navbar')

    <main>
        <div class="py-5">
            <div class="container">
                @if (session('message'))
                    <div class="alert alert-{{ session('message-type') ? session('message-type') : 'success' }}">
                        {{ session('message') }}</div>
                @endif

            </div>
            @yield('content')
        </div>
    </main>
    @yield('modals')
    @yield('scripts')
</body>

</html>
