@php
$link_style = "hover:text-indigo-500"
@endphp
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
    <nav class="hidden md:flex space-x-8 text-gray-700 font-medium">
        <a href="{{ route('home') }}" class="{{ $link_style }}">Top</a>
        <a href="{{ route('dashboard') }}" class="{{ $link_style }}">DB</a>
        <a href="{{ route('tweet.index') }}" class="{{ $link_style }}">Tweet</a>
        <a href="{{ route('tweet_js.index') }}" class="{{ $link_style }}">T (JS)</a>
        <a href="{{ route('tweet_rails.index') }}" class="{{ $link_style }}">T (Rails)</a>
        <a href="{{ route('chat.index') }}" class="{{ $link_style }}">Chat</a>
        <a href="{{ route('chat_echo.index') }}" class="{{ $link_style }}">C (Echo)</a>
        @auth
            <a href="{{ route('profile.edit') }}" class="{{ $link_style }}">プロフィール</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="{{ $link_style }}">
                    ログアウト
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="{{ $link_style }}">login</a>
            <a href="{{ route('register') }}" class="{{ $link_style }}">register</a>
        @endauth
    </nav>

    <!-- Mobile Button -->
    <button @click="open = !open" class="md:hidden text-2xl">
        ☰
    </button>
</div>