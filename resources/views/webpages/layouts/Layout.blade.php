<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">

        <title>Layout</title>
    </head>
    <body>

        <div class="relative min-h-screen">
            @include('webpages.components.Navbar')

            @yield('Content')

            @include('webpages.components.Footer')
        </div>
    </body>

    @stack('script')

</html>
