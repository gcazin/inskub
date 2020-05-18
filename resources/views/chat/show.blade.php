@extends('chat.layouts.base')

@section('chat')
    <div class="d-flex flex-column automatic-height h-100">
        @if(! is_null(request()->route('id')))
            <div class="flex-2 py-3 overflow-auto" style="flex: 1">
                <livewire:get-messages-chat :conversation="@request()->route('id')">
            </div>
            <div class="" style="padding-bottom: 150px">
                <livewire:create-message-chat :conversation="@request()->route('id')">
                    @else
                        <div class="alert alert-info">
                            Aucune conversation sélectionné
                        </div>
            </div>
        @endif
    </div>
@endsection
