<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>首页</title>
    <meta name="robots" content="noindex, follow"/>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
{{--    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">--}}
    <link rel="stylesheet" href="/assets/css/vendor/vendor.min.css">
    <link rel="stylesheet" href="/assets/css/plugins/plugins.min.css">
    <link rel="stylesheet" href="/assets/css/style.min.css">

    <script src="/assets/js/vendor/vendor.min.js"></script>
    <script src="/assets/js/plugins/plugins.min.js"></script>
    <script src="/assets/js/coco-message.js"></script>
    <style>
        .first_title{
            font-weight: bold !important;
            color: #408ed4;
        }
    </style>
    <script>
        cocoMessage.config({
            duration: 2000,
        });
    </script>


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
