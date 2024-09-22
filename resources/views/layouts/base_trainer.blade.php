<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>HacLongGolfAcademy</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- <link rel="stylesheet" href="{{asset('css/style.css')}}"> -->
    <link rel="stylesheet" href="{{asset('fontawesome-free-6.4.0-web/css/all.min.css')}}">
    <!-- Google Fonts -->
{{--    <link rel="preconnect" href="https://fonts.googleapis.com">--}}
{{--    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>--}}
{{--    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">--}}

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
<div class="container-fluid position-relative d-flex p-0">
    @include('layouts.spinner')
    <!-- Sidebar Start -->
    @include('layouts.sidebar_trainer')
    <!-- Sidebar End -->

    <!-- Content Start -->
    <div class="content">
        <!-- Navbar Start -->
        @include('layouts.header_trainer')
        <!-- Navbar End -->

        @yield('main')
        @include('layouts.footer')
    </div>
    <!-- Content End -->

    <!-- Back to Top -->
    <a href="#" id="back-to-top" class="btn btn-lg btn-primary btn-lg-square back-to-top">
        <i class="fa-solid fa-arrow-up"></i>
    </a>
    <script>
        $(document).ready(function() {
            // Khi nhấn vào nút
            $('#back-to-top').click(function(event) {
                // Ngăn chặn hành động mặc định của liên kết
                event.preventDefault();
                // Cuộn trang lên trên
                $('html, body').animate({ scrollTop: 0 }, '300'); // 300 là thời gian cuộn trong mili giây
            });
        });
    </script>
</div>

<!-- JavaScript Libraries -->
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>

<!-- Custom JavaScript -->
<script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
