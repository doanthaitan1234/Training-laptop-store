<!DOCTYPE html>
<html lang="en">

<head>
    <title>Product</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.png" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('bower_components/laptop-store-template/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('bower_components/laptop-store-template/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('bower_components/laptop-store-template/fonts/iconic/css/material-design-iconic-font.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('bower_components/laptop-store-template/fonts/linearicons-v1.0.0/icon-font.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('bower_components/laptop-store-template/vendor/animate/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('bower_components/laptop-store-template/vendor/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('bower_components/laptop-store-template/vendor/animsition/css/animsition.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('bower_components/laptop-store-template/vendor/select2/select2.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('bower_components/laptop-store-template/vendor/daterangepicker/daterangepicker.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('bower_components/laptop-store-template/vendor/slick/slick.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('bower_components/laptop-store-template/vendor/MagnificPopup/magnific-popup.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('bower_components/laptop-store-template/vendor/perfect-scrollbar/perfect-scrollbar.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/laptop-store-template/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/laptop-store-template/css/main.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/fontawesome.min.css">
    <!--===============================================================================================-->
</head>

<body class="animsition">

    <!-- Header -->

    @include('layouts.header')
    <!-- Product -->
    @yield('content')
    <!-- Footer -->
    @include('layouts.footer')
    <!-- Back to top -->
    <div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="zmdi zmdi-chevron-up"></i>
        </span>
    </div>




    <!--===============================================================================================-->
    <script src="{{ asset('bower_components/laptop-store-template/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('bower_components/laptop-store-template/vendor/animsition/js/animsition.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('bower_components/laptop-store-template/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('bower_components/laptop-store-template/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('bower_components/laptop-store-template/vendor/select2/select2.min.js') }}"></script>
    <script></script>
    <!--===============================================================================================-->
    <script src="{{ asset('bower_components/laptop-store-template/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('bower_components/laptop-store-template/vendor/daterangepicker/daterangepicker.js') }}">
    </script>
    <!--===============================================================================================-->
    <script src="{{ asset('bower_components/laptop-store-template/vendor/slick/slick.min.js') }}"></script>
    <script src="{{ asset('bower_components/laptop-store-template/js/slick-custom.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('bower_components/laptop-store-template/vendor/parallax100/parallax100.js') }}"></script>
    <script>
        $('.parallax100').parallax100();
    </script>
    <!--===============================================================================================-->
    <script
        src="{{ asset('bower_components/laptop-store-template/vendor/MagnificPopup/jquery.magnific-popup.min.js') }}">
    </script>

    <!--===============================================================================================-->
    <script src="{{ asset('bower_components/laptop-store-template/vendor/isotope/isotope.pkgd.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('bower_components/laptop-store-template/vendor/sweetalert/sweetalert.min.js') }}"></script>

    <!--===============================================================================================-->
    <script
        src="{{ asset('bower_components/laptop-store-template/vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"></script>

    <!--===============================================================================================-->
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script>
        
    </script>

    @yield('script')
</body>

</html>
