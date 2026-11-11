<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.partials.head')
    </head>
    <body class="font-sans antialiased bg-linear-to-br from-indigo-100 via-white to-blue-100 min-h-screen">
        <main class="flex min-h-screen items-center justify-center px-4" role="main">
            <div class="w-full max-w-md rounded-2xl bg-white/80 p-8 text-center shadow-xl ring-1 ring-gray-200 backdrop-blur">
                <p class="text-xs font-semibold uppercase tracking-wider text-indigo-500">
                    エラーが発生しました
                </p>

                <h1 class="mt-4 text-7xl font-bold tracking-wider text-gray-800">
                    @yield('code')
                </h1>

                <p class="mt-3 text-lg text-gray-600">
                    @yield('message')
                </p>

                <a href="{{ url('/') }}"
                   class="mt-8 inline-block app-btn-primary">
                    トップページへ戻る
                </a>
            </div>
        </main>
    </body>
</html>