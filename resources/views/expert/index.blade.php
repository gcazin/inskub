<x-page>
    <x-slot name="head">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/css/star-rating.min.css" media="all" rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/themes/krajee-svg/theme.css" media="all" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    </x-slot>

    <x-slot name="title">Recherche d'Expert</x-slot>

    <x-header>
        <x-slot name="title">Rechercher un expert</x-slot>
        <x-slot name="subtitle">Trouver l'expert qui correspond à votre besoin en toute simplicité</x-slot>
        <x-slot name="content">
                <div class="form-group">
                    <label>Domaine de compétence</label>
                    <select class="skills form-control input" id="skills" name="skills[]" multiple>
                        @foreach(\App\Models\Skill::all() as $skill)
                            <option value="{{ $skill->id }}">{{ ucfirst($skill->title) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="departments">Localisation</label>
                    <select class="departments form-control input" id="departments" name="departments[]" multiple>
                        @foreach(\App\Models\Department::all()->sortBy('code') as $department)
                            <option value="{{ $department->code }}">{{ $department->code .' - '. $department->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" name="agreed_expert" id="agreed_expert">
                        <label class="custom-control-label" for="agreed_expert">Expert agrée</label>
                    </div>
                </div>

                <div class="form-group" id="companies">
                    <label for="companies">Compagnies</label>
                    <select name="companies" class="form-control input" id="companies">
                        @foreach(\App\Models\Company::all() as $company)
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                </div>

                <x-form.submit id="btn-search">Rechercher</x-form.submit>
        </x-slot>
    </x-header>

    <x-container>
        <div class="row" id="experts-list">
            @foreach($experts as $expert)
                <x-user.item :user="$expert"></x-user.item>
            @endforeach
        </div>
    </x-container>

    <x-element.load-more-button></x-element.load-more-button>

    <x-slot name="script">
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/js/star-rating.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/js/locales/fr.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/themes/krajee-svg/theme.js"></script>
        <script>
            $(document).ready(function(){
                $('.kv-ltr-theme-svg-star').rating({
                    displayOnly: true,
                    step: 0.5,
                    hoverOnClear: false,
                    theme: 'krajee-svg',
                    language: 'fr'
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('.skills').select2();
                $('.departments').select2();
            });
        </script>

        <script type="text/javascript">
            let agreedExpert = $('input#agreed_expert')
            let companies = $('#companies')

            $(companies).hide()
            agreedExpert.change(function() {
                if($(agreedExpert).is(':checked')) {
                    $(companies).show()
                } else {
                    $(companies).hide()
                }
            })
        </script>

        <script type="module">
            import { loadMoreData } from "{{ asset('js/ajax.js') }}"

            loadMoreData('/experts', 'experts-list')
        </script>

        <script type="text/javascript">
            let input = $('.input')
            let btnSearch = $('#btn-search')

            $(input).change(function (e) {
                e.preventDefault();

                let formData = {
                    skills: $('#skills').val(),
                    departments: $('#departments').val(),
                    companies: $('#companies').val(),
                };
                let type = "POST";
                let ajaxurl = "{{ config('app.url') }}/experts/search";

                $.ajax({
                    type: type,
                    url: ajaxurl,
                    data: formData,
                    dataType: 'json',
                    success : function(data) {
                        if (data.html.length === 0) {
                            $('#experts-list').html(data.html);
                            $('#load-more').text("Aucun résultat").attr('disabled', true)
                        } else {
                            if(data.initial) {
                                $('#load-more').html("Voir plus").attr('disabled', false)
                                $('#experts-list').html(data.html);
                            } else {
                                let plural = data.html.length <= 1 ? '' : 's'

                                $('#load-more').text(data.html.length + " résultat" + plural).attr('disabled', true)
                                $('#experts-list').html(data.html);
                            }
                        }
                    },
                    error: function (data) {
                        console.log('Erreur : ', data.errors);
                    }
                });
            });
        </script>
    </x-slot>

</x-page>
