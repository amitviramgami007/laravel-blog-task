<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        @include('layouts.authentication.css')
        @yield('style')
    </head>
    <body class="hold-transition">
        @yield('content')
        @include('layouts.authentication.script')
    </body>
</html>
