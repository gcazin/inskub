<?php

namespace App\Http\Livewire;

use App\User;
use Livewire\Component;

class FollowUser extends Component
{
    public $user;

    public function mount($user)
    {
        $this->user = $user;
    }

    public function follow()
    {
        $user = User::find(auth()->user()->id);

        $user->toggleFollow($this->user);

        session()->flash('follow', 'Vous suivez maintenant ' . $user->name);
    }

    public function render()
    {
        return view('livewire.follow-user');
    }
}
