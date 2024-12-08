<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield("title","To Do App")</title>
    <link href="{{asset("assets/css/bootstrap.min.css")}}" rel="stylesheet">
    @yield("style")
  </head>
  <body class="d-flex align-items-center py-4 bg-body-tertiary">

        @yield("content")

    {{-- <script src="{{asset("assets/js/bootstrap.min.js")}}" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> --}}
    <script src="{{asset("assets/js/bootstrap.min.js")}}" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>
