<form method="POST" action="{{ $action }}" @isset($enctype) enctype="multipart/form-data" @endisset>
    @csrf
    @method($method ?? 'POST')

    @if ($errors->any())
        <x-alert type="danger mb-3">
            <x-slot name="title">Des erreurs se sont produites:</x-slot>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-alert>
    @endif

    {{ $slot }}
</form>
