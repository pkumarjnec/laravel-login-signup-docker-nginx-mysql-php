<!doctype html>
<html lang="en">
<head>
    @include('external/layout/seo')
    @include('external/layout/fonts')
    <link rel="stylesheet" href="{{asset('/common/css/bootstrap.min.css')}}" crossorigin="anonymous">
    @yield('page-css')
</head>
<body>
@yield('header')

@yield('content')

@yield('footer')

<script src="{{asset('/common/js/jquery.min.js')}}"></script>
<script src="{{asset('/common/js/bootstrap.min.js')}}" crossorigin="anonymous"></script>
@yield('page-script')
</body>
</html>