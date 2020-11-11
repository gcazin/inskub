@component('mail::message')
# Compte crée

Votre compte a été crée sur la plateforme Inskub.<br>

Vous avez été ajouté par *{{ $school->last_name }}*.

@component('mail::panel')
Nom d'utilisateur : **{{ $professor->email }}**<br>
Mot de passe : **{{ $password }}**
@endcomponent

@component('mail::button', ['url' => route('login')])
Se connecter
@endcomponent

Merci de ne pas répondre à cet email,<br>
L'équipe {{ config('app.name') }}
@endcomponent
