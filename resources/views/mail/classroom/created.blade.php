@component('mail::message')
Vous avez été ajouté à la salle de classe "{{ $project->title }}" par *{{ $professor->last_name . ' ' . $professor->first_name }}.*<br>

@component('mail::button', ['url' => route('project.show', $project->id)])
Accéder à la classe
@endcomponent

Merci de ne pas répondre à cet email,<br>
L'équipe {{ config('app.name') }}
@endcomponent
