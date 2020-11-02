<a href="{{ $url }}" class="btn btn-link {{ isset($size) ? 'btn-'.$size : null }} {{ $class ?? null }}">
    {{ $slot }}
</a>
