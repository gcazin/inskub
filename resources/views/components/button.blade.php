<button id="{{ $id ?? null }}" class="btn btn-{{ $type }} {{ isset($size) ? 'btn-'.$size : null }}" {{ $props ?? null }}>
    {{ $slot }}
</button>
