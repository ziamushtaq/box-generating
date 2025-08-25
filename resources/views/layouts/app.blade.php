<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Boxes Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      .box {
        border: 1px solid #000;
      }
    </style>
  </head>
  <body>
    @yield('content')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
  </body>
</html>
