<?php

namespace App\Http\Livewire;

use App\User;
use Livewire\Component;
use Musonza\Chat\Facades\ChatFacade as Chat;
use Musonza\Chat\Models\Conversation;

class GetMessagesChat extends Component
{
    public $messages;

    public $addedMessageVisible = false;

    protected $listeners = ['postAdded' => 'submit'];

    public function mount($conversationId)
    {
        $this->messages = Chat::conversation(Conversation::find($conversationId))
            ->setParticipant(User::find(auth()->id()))
            ->getMessages()
            ->toArray();

        $this->addedMessageVisible = true;
    }

    public function render()
    {
        return view('livewire.get-messages-chat');
    }
}
