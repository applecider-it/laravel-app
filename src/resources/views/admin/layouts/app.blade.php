@props(['breadcrumbs' => null])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('admin.layouts.partials.head')
    </head>
    <body class="font-sans antialiased bg-linear-to-br from-indigo-100 via-white to-blue-100 min-h-screen">
        @include('partials.app.container')
        @include('admin.layouts.partials.navigation')

        @isset($breadcrumbs)
            {{ Breadcrumbs::render(...$breadcrumbs) }}
        @endisset

        @include('partials.message.session')

        <div>
            {{ $slot }}
        </div>
    </body>
</html>
