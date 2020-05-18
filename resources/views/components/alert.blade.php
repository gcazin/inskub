<div class="alert alert-{{ $type }} rounded-lg">
    <ion-icon
        class="align-text-top h5 mb-0 mr-1"
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

        @endswitch></ion-icon>
    {{ $slot }}
</div>
