<x-page title="Connexion">
    <x-header>
        <x-slot name="title">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    Connexion
                </div>
            </div>
        </x-slot>
    </x-header>

    <x-container>
        <x-section class="col-lg-8 mx-auto py-4 shadow-sm rounded-lg" id="container-login-form">
            <div class="container" id="login-form">
                <x-form.item :action="route('login')">
                    <!-- Mail -->
                    <x-form.input label="Adresse e-mail" type="email" name="email" placeholder="Adresse e-mail"></x-form.input>

                    <!-- Mail -->
                    <x-form.input label="Mot de passe" type="password" name="password" placeholder="Mot de passe"></x-form.input>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck1" checked>
                        <label class="custom-control-label" for="customCheck1">Se souvenir de moi?</label>
                    </div>

                    <x-form.submit>Se connecter</x-form.submit>
                </x-form.item>
                <hr>
                <p>Pas encore de compte? <a href="{{ route('register') }}">Inscrivez-vous</a></p>
            </div>
        </x-section>
    </x-container>

    <x-slot name="script">
        @section('script')
            <script src="{{ asset('js/particles.min.js') }}"></script>

            <script>
                /* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
                particlesJS.load('particles-js', '{{ asset('js/particlesjs-config.json') }}', function() {
                    console.log('callback - particles.js config loaded');
                });
            </script>
        @endsection
    </x-slot>
</x-page>
