<x-section class="mb-3 animate__animated animate__fadeIn">
    <h5 class="mb-3">{{ $title }}</h5>

    @isset($target)
        @if((int) request()->id === (int) auth()->id())
            <button class="btn text-primary" data-toggle="modal" data-target="#{{ $target }}">
                <ion-icon class="h3 mb-0" name="add-circle-outline"></ion-icon>
            </button>
        @endif
    @endisset
    {{ $slot }}
</x-section>
