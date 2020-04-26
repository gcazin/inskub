@extends('layouts.base')

@section('content')
    @auth
        @include('partials.post-list')
    @endauth
@endsection

@section('script')
    <script>
        let shareButton = document.querySelector('.shareButton');

        shareButton.addEventListener('click', () => {
            if (navigator.share) {
                navigator.share({
                    title: 'WebShare API Demo',
                    url: 'https://codepen.io/ayoisaiah/pen/YbNazJ'
                }).then(() => {
                    console.log('Thanks for sharing!');
                })
                    .catch(console.error);
            } else {
                shareDialog.classList.add('is-open');
            }
        });
    </script>
@endsection
