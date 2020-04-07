<?php

namespace App\Http\Livewire;

use App\User;
use Livewire\Component;
use Musonza\Chat\Facades\ChatFacade as Chat;
use Musonza\Chat\Models\Conversation;

class CreateMessageChat extends Component
{
    public $conversation;
    public $message;

    public function mount($conversation) {
        $this->conversation = $conversation;
    }

    public function submit()
    {
        Chat::message($this->message)
            ->from(User::find(auth()->id()))
            ->to(Conversation::find($this->conversation))
            ->send();

        $this->emit('messageAdded');
    }

    public function render()
    {
        return view('livewire.create-message-chat');
    }
}
