<header
    class="position-relative pt-6 {{ isset($content) ? 'pb-9' : 'pb-6' }} px-lg-10 px-4"
    style="background: linear-gradient(180deg, rgba(22, 70, 188, 0.8) 0%, rgba(22, 70, 188, 0.8) 100%, #1646BC 100%, rgba(22, 70, 188, 0.6) 100%);">

    @auth
        @if (flash()->message)
            <x-element.toast :type="flash()->class" name="toast">
                {{ flash()->message }}
            </x-element.toast>
        @endif
    @endauth
    <div id="particles-js"></div>

    <div class="position-relative" style="z-index: 1">
        @isset($title)
            <h1 style="font-size: 3rem" class="text-white">{{ $title }}</h1>
        @endisset

        @isset($subtitle)
            <p class="text-white-50 h5 @isset($description) mb-5 @endisset">{{ $subtitle }}</p>
        @endif

        @isset($description)
            {{ $description }}
        @endisset
    </div>
</header>

@isset($content)
    <x-container class="mt-n6 mt-lg-n5">
        <x-section class="position-relative">
            {{ $content }}
        </x-section>
    </x-container>
@endisset
