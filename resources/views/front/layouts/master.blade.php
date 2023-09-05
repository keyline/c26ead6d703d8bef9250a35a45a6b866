@include('front.elements.head')

@include('front.elements.header')

@yield('content')

@include('front.elements.footer')

@include('front.elements.stickySocialSidebar')

@include('front.elements.pagesCommonScripts')

@stack('scripts')