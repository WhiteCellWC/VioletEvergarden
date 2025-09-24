<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Inertia</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body class="antialiased">
    @routes
    @inertia
  </body>
</html>
