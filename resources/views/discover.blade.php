@extends('layouts.base', ['full_width' => false])

@section('content')

    @foreach($roles as $role)
        <div class="group mb-5">
            <div class="group__title bg-gray-200 p-2 rounded-t">
                <h1 class="text-xl">{{ $role->display_name }}</h1>
            </div>
            <div class="group__content bg-white p-2 rounded-b">
                <div class="flex">
                    @foreach($role->users as $member)
                        <div class="rounded flex-1 group__content-card px-2 text-center border border-gray-200">
                            <div class="flex justify-center py-4">
                                <img class="h-16 rounded-full" src="{{ $user->find($member->id)::getAvatar($member->id) }}" alt="">
                            </div>
                            <p class="pb-4 font-bold">{{ $member->name }}</p>
                            <p class="pb-4 text-gray-600">
                                {{ count(\App\User::find($member->id)->followers()->get()) }} abonnés
                            </p>
                            <p class="pb-4">
                                <livewire:follow-user :user="$member->id">
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach

@endsection
