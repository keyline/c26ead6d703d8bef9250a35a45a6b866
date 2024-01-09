<!doctype html>
<html lang="en">
<head>
@include('front.elements.head')
</head>
<body>
    <header class="header">
@include('front.elements.header')
    </header>

@yield('content')

@include('front.elements.footer')

@include('front.elements.stickySocialSidebar')

@include('front.elements.pagesCommonScripts')

@stack('scripts')
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
</body>
</html>