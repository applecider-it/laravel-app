@props([
    'url',
    'color' => 'primary',
    'align' => 'center',
])
<a href="{{ $url }}"  align="{{ $align }}" class="button button-{{ $color }}" target="_blank" rel="noopener">{!! $slot !!}</a>
