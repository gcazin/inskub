@extends('layouts.base')

@section('title')
    Accueil
@endsection

@section('content')
    @if(session()->has('thanks_report'))
        <x-toast title="Signalement envoyé" type="success" name="thanks_report">Merci de votre signalement</x-toast>
    @endif

    <x-header>
        <x-slot name="title">Fil d'actualité</x-slot>

        <x-slot name="content">
            <x-submit-post :action="route('index')"></x-submit-post>
        </x-slot>
    </x-header>

    <x-container>
        <x-post-list :model="$posts"></x-post-list>
    </x-container>

    <x-loading></x-loading>
@endsection

@section('script')
    <script type="module">
        import {loadMoreDataInfinite} from ''

        loadMoreDataInfinite('/index', 'post-list')
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
    <script>
        $(document).ready(function($){
            $("#btn-add").click(function (e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();
                let formData = {
                    content: $('#form-content').val(),
                    visibility_id: $('#visibility_id').val(),
                };

                console.log(formData.content)
                let state = $('#btn-add').val();
                let type = "POST";
                let ajaxurl = '/index';
                $.ajax({
                    type: type,
                    url: ajaxurl,
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        $('#post-list').prepend(data).fadeIn('slow')
                    },
                    error: function (data) {
                        console.log('Erreur : ' + data.response);
                    }
                });
            });
        });
    </script>
@endsection
