<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.partials.head')
    </head>

    <body
        class="bg-linear-to-br from-indigo-100 via-white to-blue-100 min-h-screen">
        <div class="flex flex-col min-h-screen">
            <div class="grow flex items-center justify-center">
                <div class="w-full max-w-md mx-auto px-5 py-10 text-center translate-y-[-10vh]">

                    <!-- アプリアイコン -->
                    <div class="mx-auto flex h-24 w-24 items-center justify-center rounded-3xl bg-linear-to-br from-indigo-500 to-blue-500 shadow-xl shadow-indigo-300/50">
                        <svg class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>

                    <!-- タイトル -->
                    <h1 class="mt-6 text-2xl font-bold tracking-tight text-slate-800">Laravel Appli</h1>
                    <p class="mt-2 text-sm text-slate-500">ようこそ。</p>

                    <!-- 主要アクション -->
                    <div class="mt-10 space-y-3 text-left">
                        <a href="{{ route('home') }}"
                            class="flex items-center gap-4 rounded-2xl bg-white/80 p-4 shadow-sm ring-1 ring-slate-200 backdrop-blur transition active:scale-[0.98] hover:shadow-md">
                            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h4v-6h4v6h4a1 1 0 001-1V10" />
                                </svg>
                            </span>
                            <span class="grow">
                                <span class="block font-semibold text-slate-800">トップページ</span>
                                <span class="block text-xs text-slate-500">アプリのホームを開く</span>
                            </span>
                            <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>