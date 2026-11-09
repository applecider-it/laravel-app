<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.partials.head')
    </head>
    <body class="font-sans antialiased bg-linear-to-br from-indigo-100 via-white to-blue-100 min-h-screen">
        @include('partials.app.container')
        @include('layouts.partials.navigation')
        @include('partials.message.session')

        <div>
            {{ $slot }}
        </div>
    </body>
</html>
