<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

    @yield('title')
    <title> مصلحة الشهر العقارى</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset("image/shar3.jpg")}}">
    <link rel="stylesheet" href="{{asset("css/font-awesome.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/bootstrap.min.css")}}">
    @yield('linkCss')
</head>
<body>
    {{--@include('includes.nav')--}}
        @yield('content')
       <div class="mt-3">@include('includes.messages')</div>

    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    @yield('script')
</body>
</html>
