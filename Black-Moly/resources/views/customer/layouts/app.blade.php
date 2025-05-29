<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/fav.svg')}}">
    <title>Auto-Moly | Find the Best Deals on New & Used Vehicles</title>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/fonts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/ion.rangeSlider.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/ion.rangeSlider.skinFlat.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/js/plugin/magnific/magnific-popup.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/js/plugin/slick/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/js/plugin/slick/slick-theme.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/js/plugin/nice_select/nice-select.css')}}">
    <!----Revolution slider---->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/js/plugin/revolution/css/settings.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <!-- Favicon Link -->
    <link rel="shortcut icon" type="image/png" href="{{asset('assets/images/favicon.png')}}">
</head>
<body>

<!-- Preloader -->
<div id="preloader">
    <div id="status">
        <img src="images/logo.png" alt="" />
        <div class="loader">
            Loading...
            <div class="ball"></div>
            <div class="ball"></div>
            <div class="ball"></div>
        </div>
    </div>
</div>

@include('customer.components.header')

@yield('content')

@include('customer.components.footer')

<!-- Include the chatbot component -->
@include('customer.components.chatbot')

<span class="gotop">
            <img src="{{ asset('assets/images/goto.png') }}" alt="">
        </span>

<!-- Main JS files -->
<script type="text/javascript" src="{{ asset('assets/js/jquery.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/popper.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/ion.rangeSlider.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugin/magnific/jquery.magnific-popup.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugin/slick/slick.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugin/nice_select/jquery.nice-select.min.js') }}"></script>

<!-- Revolution Slider Scripts -->
<!----------Revolution slider start---------->
<script type="text/javascript" src="{{asset('assets/js/plugin/revolution/js/jquery.themepunch.revolution.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/plugin/revolution/js/jquery.themepunch.tools.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/plugin/revolution/js/revolution.extension.kenburn.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/plugin/revolution/js/revolution.extension.layeranimation.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/plugin/revolution/js/revolution.extension.navigation.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/plugin/revolution/js/revolution.extension.parallax.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/plugin/revolution/js/revolution.extension.slideanims.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/plugin/revolution/js/revolution.extension.actions.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/plugin/revolution/js/revolution.addon.slicey.min.js')}}"></script>
<!----------Revolution slider start---------->
<script type="text/javascript" src="{{asset('assets/js/custom.js')}}"></script>
<!--Main js file End-->
</body>
</html>
