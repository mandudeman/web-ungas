<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <!-- Required meta tags -->

    <meta charset="utf-8">
    
    <!-- Seo meta tag -->
    <meta name="author" content="mamun2074">
    <meta name="keywords" content="account, Accounting Software, balance sheet, cash flow, Cost Of Revenue, fixed asset schedule, ledger, multi branch, Profit Or Loss Account, receive payment, trial balance">
    <meta name="description" content="E-Account is a dynamic, open source, easy to use, user friendly web base application. Which is built in PHP – MySQL">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- End -->

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('asset/plugins/bootstrap/v400/bootstrap.min.css') }}" rel="stylesheet">

    {{--Report style--}}
    <link rel="stylesheet" href="{{ asset('asset/css/report.css') }}">


    <title>@yield('title', 'Report')</title>


    @stack('include-css')

    {{--Utility Css--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/layout/css/util.css') }}">



</head>
<body>

@yield('content')

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<!-- Jquery Core Js -->
<script src="{{ asset('asset/plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap Core Js -->
<script src="{{ asset('asset/plugins/bootstrap/js/bootstrap.js') }}"></script>


</body>
</html>
