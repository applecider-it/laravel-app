<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.partials.head')
    </head>
    <body class="font-sans antialiased bg-linear-to-br from-indigo-100 via-white to-blue-100 min-h-screen">
        <div class="flex justify-center min-h-screen items-center" role="main">
            <div class="mx-auto">
                <div class="flex items-center justify-start">
                    <h1 class="px-4 text-lg text-gray-700 border-r border-gray-400 tracking-wider">
                        @yield('code')
                    </h1>

                    <div class="ml-4 text-lg text-gray-700 uppercase tracking-wider">
                        @yield('message')
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
