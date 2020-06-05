@extends('chat.layouts.base')

@section('chat')
    <div class="d-flex flex-column">
        @if(! is_null(request()->route('id')))
            <div class="py-3 overflow-auto" style="flex: 1">
                <livewire:get-messages-chat :conversation="@request()->route('id')" />
            </div>
            <div style="padding-bottom: 150px">
                <livewire:create-message-chat :conversation="@request()->route('id')" />
            </div>
        @else
            <x-alert type="info">
                Aucune conversation selectionné
            </x-alert>
        @endif
    </div>
@endsection
