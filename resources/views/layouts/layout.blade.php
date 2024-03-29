<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/font-awesome.css')}}" type="text/css">
        

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" href="/css/style.css" >
         <link rel="stylesheet" href="{{ asset('css/font-awesome.css')}}" type="text/css">
        <!-- Scripts -->
        <script type="text/javascript" src="/js/">
<script type="text/javascript" src="https://js/stripe.com/v3/"></script>
<script type="text/javascript" src="/javascripts/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="/js/checkout.js"></script>
        </script>
    </head>
    <body>
      @yield ('header')
      @yield ('content')
      @yield ('footer')
      @yield('scripts')
    </body>
</html>
