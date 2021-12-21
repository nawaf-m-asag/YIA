@include('frontend.partials.header')
@include('frontend.partials.navbar-variant.navbar-'.get_static_option('navbar_variant'))
@yield('content')
@include('frontend.partials.footer')
