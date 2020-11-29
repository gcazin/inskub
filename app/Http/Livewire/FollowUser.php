<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class FollowUser extends Component
{
    public $member;

    public function mount($member)
    {
        $this->member = $member;
    }

    public function follow()
    {
        $user = User::find(auth()->user()->id);

        $user->toggleFollow($this->member);
    }

    public function render()
    {
        return view('livewire.follow-user');
    }
}
