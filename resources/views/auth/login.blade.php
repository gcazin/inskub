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
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                <ion-icon name="mail-outline"></ion-icon>
                            </span>
                            </div>
                            <input type="email" name="email" class="form-control" placeholder="Adresse e-mail"
                                   aria-label="Adresse e-mail" aria-describedby="basic-addon1">
                        </div>
                    </div>

                    <!-- Mail -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                <ion-icon name="lock-closed-outline"></ion-icon>
                            </span>
                            </div>
                            <input type="password" name="password" class="form-control" placeholder="Mot de passe"
                                   aria-label="Mot de passe" aria-describedby="basic-addon1">
                        </div>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                        <label class="custom-control-label" for="customCheck1">Se souvenir de moi?</label>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Se connecter</button>
                    </div>
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
