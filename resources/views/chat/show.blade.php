@extends('chat.layouts.base')

@section('chat')
    <div class="row flex-column h-100">
        @if(! is_null(request()->route('id')))
            <div class="overflow-auto mt-auto" style="flex: 1">
                <livewire:get-messages-chat :conversation="@request()->route('id')" />
            </div>
            <div class="p-3">
                <livewire:create-message-chat :conversation="@request()->route('id')" />
            </div>
        @else
            <div class="m-3">
                <x-element.alert type="info">
                    <x-slot name="title">
                        Aucune conversation selectionné
                    </x-slot>
                </x-element.alert>
            </div>
        @endif
    </div>
@endsection
