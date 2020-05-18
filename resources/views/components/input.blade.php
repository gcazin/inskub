<div class="form-group">
    @if($label ?? null)
        <label class="{{ ($required ?? false) ? 'label label-required' : 'label' }}" for="{{ $name }}">
            {{ $label }}
        </label>
    @endif
    @error($name)
    <p class="text-danger" role="alert">{{ $message }}</p>
    @enderror
    <input
        autocomplete="off"
        type="{{ $type ?? 'text' }}"
        name="{{ $name }}"
        id="{{ $name }}"
        class="form-control"
        placeholder="{{ $placeholder ?? '' }}"
        value="{{ old($name, $value ?? '') }}"
        {{ ($required ?? false) ? 'required' : '' }}
    >
</div>
