@extends('layouts.base', ['full_width' => false])

@section('title')
    Découvrir
@endsection

@section('content')

    <x-container>

        <!-- Parties utilisateurs -->
        <div class="my-3">
            <div class="row">
                <div class="col">
                    <h1 class="text-xl">{{ $role->users->count() }} {{ strtolower($role->display_name) }} au total</h1>
                </div>
            </div>
            <div class="row no-gutters justify-content-between flex-wrap pb-4">
                @foreach($role->users as $member)
                    <div class="card border shadow-sm text-center mb-3" style="width: 18rem">
                        <div class="flex justify-center py-4">
                            <a href="{{ route('user.profile', $member->id) }}">
                                <img style="height: 80px" class="rounded-circle border border-light" src="{{ $member->getAvatar($member->id) }}" alt="">
                            </a>
                        </div>
                        <a href="{{ route('user.profile', $member->id) }}" class="pb-4 text-blue-800 hover:underline focus:underline">{{ $member->first_name }} {{ $member->last_name }}</a>
                        <p class="pb-4 text-gray-600">
                            {{ count($member->followers()->get()) }} abonnés
                        </p>
                        <p class="pb-4">
                            <livewire:follow-user :member="$member->id">
                        </p>
                    </div>
                @endforeach
            </div>
        </div>

    </x-container>

    <x-right-sidebar-message></x-right-sidebar-message>
@endsection
