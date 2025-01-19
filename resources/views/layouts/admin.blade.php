<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Shared on THEMELOCK.COM - Dashboard | Silva - Responsive Admin Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc."/>
        <meta name="author" content="Zoyothemes"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('admin/assets/images/favicon.ico')}}">

        <!-- App css -->
        <link href="{{asset('admin/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />

        <!-- Icons -->
        <link href="{{asset('admin/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />

    </head>

    <!-- body start -->
    <body data-menu-color="light" data-sidebar="default">

        <div id="app-layout">
            {{-- nav start --}}
            @include('layouts.admin.navbar')
            {{-- nav end --}}

            {{-- sidebar start --}}
            @include('layouts.admin.sidebar')
            {{-- sidebar end --}}

            {{-- content start --}}
            <div class="content-body">
            <!-- row -->
                <div">
                    @yield('content')
                </div>
            </div>
            {{-- content end --}}

            {{-- footer start --}}
            @include('layouts.admin.footer')
            {{-- footer end --}}

        </div>

    <!-- Vendor -->
    <script src="{{asset('admin/assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('admin/assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('admin/assets/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{asset('admin/assets/libs/waypoints/lib/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('admin/assets/libs/jquery.counterup/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('admin/assets/libs/feather-icons/feather.min.js')}}"></script>

    <!-- Apexcharts JS -->
    <script src="{{asset('admin/assets/libs/apexcharts/apexcharts.min.js')}}"></script>

    <!-- for basic area chart -->
    <script src="https://apexcharts.com/samples/assets/stock-prices.js"></script>

    <!-- Widgets Init Js -->
    <script src="{{asset('admin/assets/js/pages/crm-dashboard.init.js')}}"></script>

    <!-- App js-->
    <script src="{{asset('admin/assets/js/app.js')}}"></script>

    </body>
</html>