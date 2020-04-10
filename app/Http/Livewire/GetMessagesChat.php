<?php

namespace App\Http\Livewire;

use App\User;
use Livewire\Component;
use Musonza\Chat\Facades\ChatFacade as Chat;
use Musonza\Chat\Models\Conversation;

class GetMessagesChat extends Component
{
    public $conversation;
    public $messages;
    public $isDirect;

    protected $listeners = ['messageAdded' => '$refresh'];

    public function mount($conversation)
    {
        $this->conversation = Conversation::find($conversation);
    }

    public function render()
    {
        $this->messages = Chat::conversation($this->conversation)
            ->setParticipant(User::find(auth()->id()))
            ->getMessages()
            ->toArray()['data'];
        $this->isDirect = $this->conversation->direct_message;
        return view('livewire.get-messages-chat', ['messages' => $this->messages, 'direct' => $this->isDirect]);
    }
}
