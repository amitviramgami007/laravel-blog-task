<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Admin Panel</title>
        <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        @include('layouts.simple.css')
        @yield('style')
    </head>
    <body class="hold-transition sidebar-mini layout-fixed layout-footer-fixed layout-navbar-fixed">
        <div class="wrapper">
            <!-- Navbar -->
            @include('layouts.simple.header')
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            @include('layouts.simple.sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                @include('layouts.simple.breadcrumb')
                <!-- /.content-header -->

                <!-- Main content -->
                @yield('content')
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Main Footer -->
            {{-- @include('layouts.simple.footer') --}}
        </div>
        <!-- ./wrapper -->

        @include('layouts.simple.script')
        @include('layouts.simple.flash')
    </body>
</html>
