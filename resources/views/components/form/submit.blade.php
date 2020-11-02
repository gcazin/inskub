<div class="text-right">
    <button type="submit" class="btn btn-{{ $type ?? 'primary' }}" @isset($id) id="{{ $id }}" @endif>
        {{ $slot }}
    </button>
</div>
