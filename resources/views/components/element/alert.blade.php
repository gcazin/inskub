<div class="alert alert-{{ $type }} d-flex align-items-center rounded-lg px-3 py-3 mb-3 {{ $class ?? null }}" @isset($id) id="{{ $id }}" @endisset>
    <div class="icon-container mx-3">
        <ion-icon
            class="align-text-top h4 mb-0"
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
    </div>
    <div class="col">
        <p class="h6 mb-0">{{ $title }}</p>
        @if(isset($description))
            <p class="mb-0 mt-2 text-muted">{{ $description ?? null }}</p>
        @endif
    </div>
</div>
