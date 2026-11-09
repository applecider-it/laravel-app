@php
$link_style = "hover:text-indigo-500"
@endphp
<nav x-data="{ open: false }" class="bg-gray-200 shadow-md">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <!-- Logo -->
        <a href="/">
            <div
                class="text-2xl font-bold bg-linear-to-r from-indigo-500 to-purple-500 bg-clip-text text-transparent"
            >
                MySite
            </div>
        </a>

        <!-- Desktop Menu -->
        <nav class="flex space-x-8 text-gray-700 font-medium">
            <a href="{{ route('admin.dashboard') }}" class="{{ $link_style }}">dashboard</a>
            <a href="{{ route('admin.users.index') }}" class="{{ $link_style }}">ユーザー</a>
            @auth
                <span>{{ Auth::guard('admin')->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="{{ $link_style }}">
                        ログアウト
                    </button>
                </form>
            @endauth
        </nav>
    </div>
</nav>
