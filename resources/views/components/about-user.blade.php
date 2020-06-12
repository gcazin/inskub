<x-section class="mb-3 animate__animated animate__zoomIn">
    <div class="row">
        <div class="col mb-3">
            <h5>{{ $title }}</h5>
        </div>

        @isset($target)
            @if((int) request()->id === (int) auth()->id())
                <div class="col text-right">
                    <button class="btn text-primary" data-toggle="modal" data-target="#{{ $target }}">
                        <ion-icon class="h3 mb-0" name="add-circle-outline"></ion-icon>
                    </button>
                </div>
            @endif
        @endisset
    </div>
    {{ $slot }}
</x-section>
