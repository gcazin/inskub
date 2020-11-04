<header
    class="position-relative pt-6 {{ isset($content) ? 'pb-9' : 'pb-6' }} px-lg-10 px-4"
    style="background: linear-gradient(180deg, rgba(22, 70, 188, 0.8) 0%, rgba(22, 70, 188, 0.8) 100%, #1646BC 100%, rgba(22, 70, 188, 0.6) 100%);">

    <div id="particles-js"></div>

    @isset($title)
        <h1 style="font-size: 3rem" class="text-white">{{ $title }}</h1>
    @endisset

    @isset($subtitle)
        <p class="text-white-50 h5 @isset($description) mb-5 @endisset">{{ $subtitle }}</p>
    @endif

    @isset($description)
        {{ $description }}
    @endisset
</header>

@isset($content)
    <section class="position-relative p-lg-4 p-2 mt-n5 mx-lg-10 mx-2 bg-white shadow-sm rounded-lg">
        {{ $content }}
    </section>
@endisset
