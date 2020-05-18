<div class="form-group">
    @if($label ?? null)
        <label class="{{ ($required ?? false) ? 'label label-required' : 'label' }}" for="{{ $name }}">
            {{ $label }}
        </label>
    @endif
    @error($name)
    <p class="text-danger" role="alert">{{ $message }}</p>
    @enderror
    <textarea
        autocomplete="off"
        name="{{ $name }}"
        id="{{ $name }}"
        class="form-control"
        placeholder="{{ $placeholder ?? '' }}"
        rows="{{ $rows ?? '2' }}"
        {{ ($required ?? false) ? 'required' : '' }}
    >{{ old($name, $value ?? '') }}</textarea>
</div>
