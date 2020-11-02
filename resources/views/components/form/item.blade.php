<form method="POST" @isset($id) id="{{ $id }}" @endif action="{{ $action }}" @isset($enctype) enctype="multipart/form-data" @endisset>
    @if ($errors->any())
        <x-element.alert type="danger">
            <x-slot name="title">Des erreurs se sont produites lors de la saisie de vos informations</x-slot>
            <ul>
            @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-element.alert>
    @endif

    @csrf
    @method($method ?? 'POST')

    {{ $slot }}
</form>
