@php
$link_style = "block py-2 text-gray-700 hover:text-indigo-500"
@endphp
<!-- Mobile Menu -->
<div
  x-show="open"
  x-transition.duration.200ms
  class="px-6 pb-4 md:hidden"
  style="display: none;"
>
    <a href="{{ route('home') }}" class="{{ $link_style }}">Top</a>
    <a href="{{ route('dashboard') }}" class="{{ $link_style }}">ダッシュボード</a>
    <a href="{{ route('tweet.index') }}" class="{{ $link_style }}">Tweet</a>
    <a href="{{ route('tweet_js.index') }}" class="{{ $link_style }}">Tweet (JS)</a>
    <a href="{{ route('tweet_rails.index') }}" class="{{ $link_style }}">Tweet (Rails)</a>
    <a href="{{ route('chat.index') }}" class="{{ $link_style }}">Chat</a>
    <a href="{{ route('chat_echo.index') }}" class="{{ $link_style }}">Chat (Echo)</a>

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
</div>
