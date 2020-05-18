@extends('layouts.base', ['full' => true])

@section('content')
    <div class="col-lg-6 offset-lg-1 mt-3">
        @include('partials.post-list')
    </div>

    <x-right-sidebar>
        <h6 class="title__section text-uppercase text-secondary px-3">Messagerie</h6>
        <div class="d-flex flex-column overflow-hidden">
            @forelse(auth()->user()->followings as $person)
                <div class="chat-person position-relative d-inline-flex align-items-center py-2 px-3">
                    <div style="width: 15%">
                        <img class="rounded-circle" style="height: 2rem" src="{{ auth()->user()->getAvatar($person->id) }}" alt="">
                    </div>
                    <div style="width: 70%">
                        <span class="mr-auto font-weight-bold">{{ $person->first_name }} {{ $person->last_name }}</span>
                    </div>
                    <div class="text-center" style="width: 15%">
                        <span class="d-inline-block bg-success rounded-circle" style="height: 5px; width: 5px"></span>
                    </div>
                    <a class="position-absolute h-100 w-100" href="{{ route('chat.createConversation', $person->id) }}"></a>
                </div>
            @empty
                <div class="px-3">
                    <x-alert type="info">
                        Aucun contact
                    </x-alert>
                </div>
            @endforelse
        </div>
    </x-right-sidebar>
@endsection

@section('script')
    <script>
        let shareButton = document.querySelector('.share-button');

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
                console.log('Votre navigateur ne supporte pas ça')
                //shareDialog.classList.add('is-open');
            }
        });
    </script>
    <script>
        function displayPreview(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function (e) {
                    $('#img-preview').removeClass('d-none')
                    $('#img-preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#img-input").change(function(){
            displayPreview(this);
        });
    </script>
@endsection
