<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <script src="{{URL::to('js/vendor/jquery-1.11.2.min.js')}}" type="text/javascript"></script>
        <link href="{{URL::to('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{URL::to('css/main.css')}}" rel="stylesheet" type="text/css"/>
        <script src="{{URL::to('js/vendor/bootstrap.min.js')}}" type="text/javascript"></script>
        <script> 
            var baseUrl='{{ URL::to("") }}';
            var token='{{ Session::token() }}';
        </script>
    </head>
    <body>
        @include('includes.header')
        <div class="container">
            @yield('content')
        </div>
        @yield('scripts')
    </body>
</html>
