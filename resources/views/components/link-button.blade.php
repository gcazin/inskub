<a href="{{ $url }}" class="btn btn-{{ $type ?? 'primary' }} {{ isset($size) ? 'btn-'.$size : null }}" {{ $class ?? null }}>
    {{ $slot }}
</a>
