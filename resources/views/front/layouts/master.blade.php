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
<form action="#" method="POST" id="demo-form">
    <br>
    <button class="g-recaptcha" data-sitekey="6LfEu0opAAAAAIP82Q9XnG0dYN81-_DteAszQFMN" data-callback="onSubmit" style="display: none;">Submit</button>
</form>
</body>
</html>