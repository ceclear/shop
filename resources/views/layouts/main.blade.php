<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="keywords" content="@yield('keywords')">
    <meta name="description" content="@yield('description')">
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


    <link rel="stylesheet" type="text/css" href="/assets/css/normalize.css" />
    <link href="/assets/css/Icomoon/style.css" rel="stylesheet" type="text/css" />

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
<style>
    #loading{
        background-color: #cbcbcb;
        height: 100%;
        width: 100%;
        position: fixed;
        z-index: 999;
        margin-top: 0px;
        top: 0px;
        opacity: 0.8;
    }

    #loading-center-absolute {
        position: absolute;
        left: 50%;
        top: 50%;
        height: 20px;
        width: 100px;
        margin-top: -10px;
        margin-left: -50px;

    }
    .object{
        width: 20px;
        height: 20px;
        background-color: #408ed4;
        -moz-border-radius: 50% 50% 50% 50%;
        -webkit-border-radius: 50% 50% 50% 50%;
        border-radius: 50% 50% 50% 50%;
        margin-right: 20px;
        margin-bottom: 20px;
        position: absolute;
    }
    #object_one{
        -webkit-animation: object 2s linear infinite;
        animation: object 2s linear infinite;
    }
    #object_two{
        -webkit-animation: object 2s linear infinite -.4s;
        animation: object 2s linear infinite -.4s;
    }
    #object_three{
        -webkit-animation: object 2s linear infinite -.8s;
        animation: object 2s linear infinite -.8s;
    }
    #object_four{
        -webkit-animation: object 2s linear infinite -1.2s;
        animation: object 2s linear infinite -1.2s;
    }
    #object_five{
        -webkit-animation: object 2s linear infinite -1.6s;
        animation: object 2s linear infinite -1.6s;
    }
    @-webkit-keyframes object{
        0% { left: 100px; top:0}
        80% { left: 0; top:0;}
        85% { left: 0; top: -20px; width: 20px; height: 20px;}
        90% { width: 40px; height: 15px; }
        95% { left: 100px; top: -20px; width: 20px; height: 20px;}
        100% { left: 100px; top:0; }

    }
    @keyframes object{
        0% { left: 100px; top:0}
        80% { left: 0; top:0;}
        85% { left: 0; top: -20px; width: 20px; height: 20px;}
        90% { width: 40px; height: 15px; }
        95% { left: 100px; top: -20px; width: 20px; height: 20px;}
        100% { left: 100px; top:0; }
    }
</style>
<div id="loading" style="display: none">
    <div id="loading-center">
        <div id="loading-center-absolute">
            <div class="object" id="object_one"></div>
            <div class="object" id="object_two" style="left:20px;"></div>
            <div class="object" id="object_three" style="left:40px;"></div>
            <div class="object" id="object_four" style="left:60px;"></div>
            <div class="object" id="object_five" style="left:80px;"></div>
        </div>
    </div>
</div>

</body>
</html>
