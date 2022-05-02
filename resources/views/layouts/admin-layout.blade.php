<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @yield('title')

    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="{{ asset('bower_components/elaa-admin/assets/css/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/elaa-admin/assets/css/style.css') }}">
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet"
        href="{{ asset('bower_components/elaa-admin/assets/css/lib/datatable/dataTables.bootstrap.min.css') }}">

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!--Select 2-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @yield('header')

    <style>
        #weatherWidget .currentDesc {
            color: #ffffff !important;
        }

        .traffic-chart {
            min-height: 335px;
        }

        #flotPie1 {
            height: 150px;
        }

        #flotPie1 td {
            padding: 3px;
        }

        #flotPie1 table {
            top: 20px !important;
            right: -10px !important;
        }

        .chart-container {
            display: table;
            min-width: 270px;
            text-align: left;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        #flotLine5 {
            height: 105px;
        }

        #flotBarChart {
            height: 150px;
        }

        #cellPaiChart {
            height: 160px;
        }

    </style>
</head>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="dashboard active">
                        <a href="{{ route('admin.index') }}"><i
                                class="menu-icon fa fa-laptop"></i>{{ __('Dashboard') }} </a>
                    </li>
                    <li class="category">
                        <a href="{{ route('categories.index') }}"><i
                                class="menu-icon fa fa-tasks"></i>{{ __('Category') }} </a>
                    </li>
                    <li class="product">
                        <a href="{{ route('products.index') }}"><i
                                class="menu-icon fa fa-desktop"></i>{{ __('Product') }} </a>
                    </li>
                    <li class="order">
                        <a href="{{ route('orders.index') }}"><i
                                class="menu-icon fa fa-desktop"></i>{{ __('Order') }} </a>
                    </li>
                    <li class="user">
                        <a href="{{ route('users.index') }}"><i
                                class="menu-icon fa fa-users"></i>{{ __('User') }} </a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="./">{{ __('Admin') }}</a>
                    <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>

            <div class="top-right">

                <div class="header-menu">
                    <div class="header-left">
                        <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if (Session::get('website_language') == 'vi')
                                    {{ __('VI') }}
                                @else
                                    {{ __('EN') }}
                                @endif
                            </button>
                            <div class="dropdown-menu" aria-labelledby="notification">
                                <a class="dropdown-item media"
                                    href="{{ route('lang', ['en']) }}">{{ __('EN') }}</a>
                                <a class="dropdown-item media"
                                    href="{{ route('lang', ['vi']) }}">{{ __('VI') }}</a>
                            </div>
                        </div>


                    </div>

                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <img class="user-avatar rounded-circle"
                                src="{{ asset('bower_components/elaa-admin/images/admin.jpg') }}" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">

                            <a class="nav-link" href="#"><i
                                    class="fa fa- user"></i>{{ __('My Profile') }}</a>

                            {{-- <a class="nav-link" href="#"><i class="fa fa- user"></i>{{ __('Notifications') }} <span
                                    class="count">13</span></a> --}}

                            {{-- <a class="nav-link" href="#"><i class="fa fa -cog"></i>Settings</a> --}}

                            <a class="nav-link" href="" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" {{ __('Logout') }}><i
                                    class="fa fa-power -off"></i>{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        <!-- /#header -->
        <!-- Content -->
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                <!-- Widgets  -->
                @yield('content')

                <!-- /#add-category -->
            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
        <!-- Footer -->
        <footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6 text-right">
                    </div>
                </div>
            </div>
        </footer>
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="bower_components/elaa-admin/assets/js/main.js"></script>

    <!--  Chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>

    <!--Chartist Chart-->
    <script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
    <script src="bower_components/elaa-admin/assets/js/init/weather-init.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
    <script src="{{ asset('bower_components/elaa-admin/assets/js/init/fullcalendar-init.js') }}"></script>

    <!-- Datatable -->
    <script src="{{ asset('bower_components/elaa-admin/assets/js/lib/data-table/datatables.min.js') }}"></script>
    <script src="{{ asset('bower_components/elaa-admin/assets/js/lib/data-table/dataTables.bootstrap.min.js') }}">
    </script>
    <script src="{{ asset('bower_components/elaa-admin/assets/js/lib/data-table/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('bower_components/elaa-admin/assets/js/lib/data-table/jszip.min.js') }}"></script>
    <script src="{{ asset('bower_components/elaa-admin/assets/js/lib/data-table/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/elaa-admin/assets/js/lib/data-table/vfs_fonts.js') }}"></script>
    <script src="{{ asset('bower_components/elaa-admin/assets/js/lib/data-table/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('bower_components/elaa-admin/assets/js/lib/data-table/buttons.print.min.js') }}"></script>
    <script src="{{ asset('bower_components/elaa-admin/assets/js/lib/data-table/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('bower_components/elaa-admin/assets/js/init/datatables-init.js') }}"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <!--Select 2-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!--Input-->
    <script src=”https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js”></script>

    <script src="//cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
    <!--Input mask-->
    <script src=”https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js”></script>

    @yield('script')

    <!--Local Stuff-->
    <script>
        const WARNiNG = 3
        const INFO = 2
        const SUCCESS = 1
        const ERROR = 0
        const SESSION_SUCCESS = '1'
        const SESSION_ERROR = '0'

        $(document).ready(function($) {
            var session_code = "{{ Session::get('code') }}"
            var session_message = "{{ Session::get('message') }}"
            if (session_code == SESSION_ERROR) {
                toastr.error(session_message)
            }
            if (session_code == SESSION_SUCCESS) {
                toastr.success(session_message)
            }

            $('#menuToggle').on('click', function(event) {
                var windowWidth = $(window).width();
                if (windowWidth < 1010) {
                    $('body').removeClass('open');
                    if (windowWidth < 760) {
                        $('#left-panel').slideToggle();
                    } else {
                        $('#left-panel').toggleClass('open-menu');
                    }
                } else {
                    $('body').toggleClass('open');
                    $('#left-panel').removeClass('open-menu');
                }

            });


        });
    </script>
</body>

</html>
