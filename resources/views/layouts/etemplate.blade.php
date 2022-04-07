<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <!-- Seo meta tag -->
    <meta name="author" content="mamun2074">
    <meta name="keywords" content="account, Accounting Software, balance sheet, cash flow, Cost Of Revenue, fixed asset schedule, ledger, multi branch, Profit Or Loss Account, receive payment, trial balance">
    <meta name="description" content="E-Account is a dynamic, open source, easy to use, user friendly web base application. Which is built in PHP – MySQL">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- End -->
    

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Welcome To | '.Config::get('settings.company_name'))</title>

    <link rel="icon" href="{{ asset(Config::get('settings.company_logo')) }}" type="image/x-icon">


    <link rel="stylesheet" type="text/css"
        href="{{ asset('asset/layout/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">

    <link rel="stylesheet" type="text/css"
        href="{{ asset('asset/layout/fonts/iconic/css/material-design-iconic-font.min.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('asset/css/e-bootstrap.min.css') }}">


    {{--Utility Css--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/layout/css/util.css') }}">


    <link rel="stylesheet" type="text/css" href="{{ asset('asset/layout/css/main.css') }}">



</head>

<body>

    <div>
        @yield('auth-body')
    </div>

    <!-- Jquery Core Js -->
    <script src="{{ asset('asset/layout/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('asset/layout/js/main.js') }}"></script>

</body>

</html>
