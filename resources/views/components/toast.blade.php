<div aria-live="polite" aria-atomic="true" data-autohide="true">
    <div id="{{ $name }}" class="toast" style="position: fixed; bottom: 10px; right: 10px; z-index: 10000" data-delay="1000000">
        <div class="toast-header">
            <ion-icon
                class="align-text-bottom mt-1 h5 mb-0 mr-1 text-{{ $type }}"
                name=
                @switch($type)
                @case('primary')
                @break;
            @case('info')
            'information-circle-outline'
            @break;
            @case('warning')
            'alert-circle-outline'
            @break
            @case('danger')
            'close-circle-outline'
            @break
            @case('success')
            'checkmark-circle-outline'
            @break
            @endswitch
            ></ion-icon>
            <strong class="mr-auto text-{{ $type }} h6 mb-0">{{ $title }}</strong>
            <button type="button" class="ml-2 close" data-dismiss="toast" aria-label="Close">
                <span style="font-size: 90%" class="text-muted" aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body h6 mb-0">
            {{ $slot }}
        </div>
    </div>
</div>
