<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Home</title>
    <meta name="robots" content="noindex, follow"/>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
{{--    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">--}}
    <link rel="stylesheet" href="/assets/css/vendor/vendor.min.css">
    <link rel="stylesheet" href="/assets/css/plugins/plugins.min.css">
    <link rel="stylesheet" href="/assets/css/style.min.css">

    <script src="/assets/js/vendor/vendor.min.js"></script>
    <script src="/assets/js/plugins/plugins.min.js"></script>

    <style>
        .first_title{
            font-weight: bold !important;
            color: #408ed4;
        }
    </style>
    <script>
        window.QMSG_GLOBALS = {
            DEFAULTS:{
                showClose:false,
                timeout:2000,
                position:"center",
                maxNums:1
            }
        }
        document.write('<link rel="stylesheet" href="/assets/css/message.css?v='+new Date().getTime()+'">');
    </script>
    <script src="/assets/js/message.js"></script>
</head>
<body>
@include("layouts.header")
@include("layouts.menu")
<div>
    @yield("content")
</div>
@include('layouts.footer')
</body>
</html>
