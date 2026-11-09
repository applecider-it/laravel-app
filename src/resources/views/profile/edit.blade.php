@php
    $cardStyle = 'p-4 sm:p-8 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg';
@endphp
<x-app-layout>
    <div class="app-container-normal">
        <h2 class="app-h2">
            プロフィール
        </h2>

        <div class="space-y-6">
            <div class="{{ $cardStyle }}">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="{{ $cardStyle }}">
                @include('profile.partials.update-password-form')
            </div>

            <div class="{{ $cardStyle }}">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
