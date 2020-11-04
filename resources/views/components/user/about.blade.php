<x-section class="mb-3 animate__animated animate__fadeIn">
    <div class="row">
        <div class="col-lg col">
            <h5 class="mb-3">{{ $title }}</h5>
        </div>
        <div class="col-lg-1 col text-right">
            @isset($target)
                @if((int) request()->id === (int) auth()->id())
                    <span data-toggle="modal" style="cursor:pointer" data-target="#{{ $target }}">
                        <ion-icon class="h3 mb-0 text-primary icon-container-primary" name="add-circle-outline"></ion-icon>
                    </span>
                @endif
            @endisset
        </div>
    </div>

    {{ $slot }}
</x-section>
