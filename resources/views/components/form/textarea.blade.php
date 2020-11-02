<div class="form-group">
    @if($label ?? null)
        <label class="{{ ($required ?? false) ? 'label label-required' : 'label' }}" for="{{ $name }}">
            {{ $label }}
        </label>
    @endif

    @if($help ?? null)
        <small class="form-text text-muted">{{ $help }}</small>
    @endif

    @error($name)
    <p class="text-danger" role="alert">{{ $message }}</p>
    @enderror
    <textarea
        autocomplete="off"
        name="{{ $name }}"
        id="{{ $name }}"
        class="form-control {{ $class ?? null }}"
        placeholder="{{ $placeholder ?? '' }}"
        rows="{{ $rows ?? '2' }}"
        {{ ($required ?? false) ? 'required' : '' }}
    >{{ $slot ?? null }}</textarea>
</div>
