@extends('layouts.base', ['full_width' => false])

@section('title')
    Découvrir
@endsection

@section('content')

    <div class="col-10 p-3">
        @foreach($roles as $role)
            <div class="group mb-5">
                <div class="group__title rounded">
                    <h1 class="text-xl">{{ $role->display_name }}</h1>
                </div>
                <div class="d-flex overflow-auto pb-4">
                    @foreach($role->users as $member)
                        <div class="w-25 text-center rounded bg-white shadow-sm mr-3" style="flex: 0 0 auto">
                            <div class="flex justify-center py-4">
                                <img class="h-16 rounded-circle border border-light" src="{{ $user->find($member->id)::getAvatar($member->id) }}" alt="">
                            </div>
                            <a href="{{ route('user.profile', $member->id) }}" class="pb-4 text-blue-800 hover:underline focus:underline">{{ $member->first_name }} {{ $member->last_name }}</a>
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
    </div>

@endsection
