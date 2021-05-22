<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" type="text/css" href="{{asset('font-awesome/css/font-awesome.min.css')}}">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/offcanvas.css') }}">

    <title>{{ config('app.name', 'Texto a Voz') }}</title>

    <meta name="theme-color" content="#7952b3">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

</head>
<body>

<main class="container">
    @yield('content')
</main>

<!-- Scripts -->
<script src="{{ asset('js/jquery-3.3.1.min.js') }}" ></script>   
<script src="{{ asset('js/jquery-validate/jquery.validate.min.js') }} "></script>
<script src="{{ asset('js/jquery-validate/additional-methods.min.js') }} "></script>
<script src="{{ asset('js/jquery-form/jquery.form.min.js') }} "></script>

@yield('scripts')

</body>
</html>