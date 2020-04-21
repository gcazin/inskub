@extends('layouts.base', ['full_width' => false])

@section('content')

    @foreach($roles as $role)
        <div class="group mb-5">
            <div class="group__title p-2 rounded">
                <h1 class="text-xl">{{ $role->display_name }}</h1>
            </div>
            <div class="flex group__content rounded-b overflow-x-auto scrolling-touch pb-4">
                @foreach($role->users as $member)
                    <div class="w-1/2 bg-white rounded group__content-card text-center shadow mr-3" style="flex: 0 0 auto">
                        <div class="flex justify-center py-4">
                            <img class="h-16 rounded-full" src="{{ $user->find($member->id)::getAvatar($member->id) }}" alt="">
                        </div>
                        <a href="{{ route('user.profile', $member->id) }}" class="pb-4 text-blue-800 hover:underline focus:underline">{{ $member->last_name }} {{ $member->first_name }}</a>
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
    @endforeach

@endsection
