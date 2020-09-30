@extends('layouts.base')

@section('title')
    Accueil
@endsection

@section('content')
    @if(session()->has('thanks_report'))
        <x-toast title="Signalement envoyé" type="success" name="thanks_report">Merci de votre signalement</x-toast>
    @endif

    <x-container>
        <x-submit-post :action="route('index')"></x-submit-post>
        <x-post-list :model="$posts"></x-post-list>
    </x-container>

    <x-right-sidebar-message></x-right-sidebar-message>
@endsection

@section('script')
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
    <script>
        $(document).ready(function() {
            $('.toast').toast('show')
        })
    </script>
@endsection
