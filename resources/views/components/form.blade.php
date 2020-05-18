<form method="POST" action="{{ $action }}">
    @csrf
    @method($method ?? 'POST')
    {{ $slot }}
</form>
