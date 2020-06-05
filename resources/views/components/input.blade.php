<div class="form-group">
    @if($label ?? null)
        <label class="{{ ($required ?? false) ? 'label label-required' : 'label' }}" for="{{ $name }}">
            {{ $label }}
        </label>
    @endif
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
