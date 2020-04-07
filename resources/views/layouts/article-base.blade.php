@extends('layouts.base', ['title' => 'Articles', 'full_width' => false, 'flip_wave' => true])

@section('content')
        @yield('article-content')
        <div class="lg:flex">
        <div class="lg:w-4/12 flex-col flex">
            <div class="relative">
                <h3 class="text-xl lg:text-2xl text-indigo-800 mb-1">Recherche</h3>
                <form action="{{ route('search') }}" method="get" class="relative">
                    <input type="text" class="input" name="q" style="border-radius: 9999px !important" placeholder="Mots clés">
                    <button type="submit" class="absolute right-0 top-0 mt-3 mr-4">
                        <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                             viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
                             width="512px" height="512px">
            <path
                d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
          </svg>
                    </button>
                </form>
                <small class="text-gray-700 block text-right"><a class="link" href="{{ route('post.index') }}">recherche avancée</a></small>
            </div>
            <div class="box mb-3 lg:mb-0 mt-3">
                <h3 class="text-xl lg:text-2xl text-indigo-800 mb-1">Catégories</h3>
                <ul class="bg-white rounded-lg">
                    <li class="px-5 py-4 text-gray-700 border-gray-100 border-b text-xl">
                        <a href="{{ route('article.index') }}">Tous</a>
                        @foreach(App\Category::get(['id', 'title']) as $category)
                            <hr class="bg-primary my-1">
                            <a href="{{ route('category.index', $category->id) }}">{{ $category->title }}</a>
                        @endforeach
                    </li>
                </ul>
            </div>
        </div>
        <div class="lg:w-8/12 lg:flex lg:flex-wrap lg:justify-end">
            @foreach($articles as $article)
                @include('partials.item')
            @endforeach
        </div>
        </div>
@endsection
