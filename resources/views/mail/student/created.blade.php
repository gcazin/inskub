@component('mail::message')
# Compte crée

Votre compte à été crée sur la plateforme Inskub.<br>

Vous avez été ajouté à la salle de classe *{{ $classroom }}*.

@component('mail::panel')
Nom d'utilisateur : **{{ $email }}**<br>
Mot de passe : **{{ $password }}**
@endcomponent

@component('mail::button', ['url' => route('login')])
Se connecter
@endcomponent

Merci de ne pas répondre à cet email,<br>
L'équipe {{ config('app.name') }}
@endcomponent
