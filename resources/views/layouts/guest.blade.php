<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>HacLongGolfAcademy</title>

        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('fontawesome-free-6.4.0-web/css/all.min.css') }}">

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

        <!-- Custom CSS -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-dark text-light d-flex " style="height: 100vh;">
        <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6 text-center bg-red d-flex justify-content-center mt-4">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="img-fluid" style="max-width: 100px;">
            </div>
        </div>

            <div class="row justify-content-center mt-2">
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-body bg-dark text-light">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>


</html>
