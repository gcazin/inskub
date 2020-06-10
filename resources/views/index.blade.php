@extends('layouts.base', ['full' => true])

@section('content')
    <x-container>
        <x-submit-post :action="route('index')"></x-submit-post>
        <x-post-list :model="$posts"></x-post-list>
    </x-container>

    <x-right-sidebar-message></x-right-sidebar-message>
@endsection

@section('script')
    <script>
        let shareButton = document.querySelector('.share');

        shareButton.addEventListener('click', () => {
            try {
                navigator.share({
                    title: 'WebShare API Demo',
                    url: 'https://codepen.io/ayoisaiah/pen/YbNazJ'
                }).then(() => {
                    console.log('Thanks for sharing!');
                })
            } catch (e) {
                alert(e)
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
