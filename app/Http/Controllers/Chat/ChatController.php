<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Musonza\Chat\Chat;
use Musonza\Chat\Models\Conversation;

class ChatController extends Controller {

    /**
     * @var User $user
     */
    protected User $user;

    /**
     * @var AuthManager $auth
     */
    protected AuthManager $auth;

    /**
     * @var Chat $chat
     */
    protected Chat $chat;

    /**
     * Constructeur
     *
     * @param Chat          $chat
     * @param User          $user
     * @param AuthManager   $auth
     */
    public function __construct(Chat $chat, User $user, AuthManager $auth)
    {
        $this->user = $user;
        $this->auth = $auth;
        $this->chat = $chat;
        $this->middleware('auth');

        view()->composer('chat.layouts.base', function ($view) {
            $conversations = $this->chat->conversations()
                ->setPaginationParams(['sorting' => 'desc'])
                ->setParticipant($this->auth->user())
                ->isPrivate()
                ->get();

            $user = User::class;

            $view->with([
                'conversations' => $conversations,
                'user' => $user
            ]);
        });
    }

    /**
     * Conversation entre deux personnes
     *
     * @param $id
     *
     * @return RedirectResponse
     */
    public function createDirectConversation($id, $type = null): RedirectResponse
    {
        $conversation = $this->chat->conversations()->between(User::find($this->auth->id()), User::find($id));

        if($this->auth->id() === (int) $id) {
            return redirect()->back()->with('conversationHimself', 'Vous ne pouvez pas créer de conversation avec vous-même.');
        }

        if($conversation !== null) {
            return redirect()->route('chat.index', $conversation->id);
        }

        $conversation = $this->chat->createConversation([User::find($this->auth->id()), User::find($id)]);

        if($type !== null) {
            $conversation->type_id = 1;
        }

        $conversation->makeDirect();

        return redirect()->route('chat.index', $conversation->id);
    }

    /**
     * Conversation de groupes à plus de deux utilisateurs
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function createGroupConversation(): RedirectResponse
    {
        $this->chat->createConversation([User::find($this->auth->id()), User::find(2), User::find(3), User::find(4)]);

        return redirect()->route('chat.index');
    }

    /**
     * Conversation
     *
     * @param int $id
     *
     * @return Factory|\Illuminate\View\View
     */
    public function show(int $id = null)
    {
        $user = User::find($this->auth->user()->id);

        if($id === null) {
            return view('chat.show');
        }

        $conversation = $this->chat
            ->conversation($this->chat->conversations()->getById($id))
            ->setParticipant($user);

        $messages = $conversation->getMessages();

        $conversation->readAll();

        $participants = $this->chat->conversations()->setPaginationParams(['sorting' => 'desc'])
            ->setParticipant($user)
            ->limit(1)
            ->page(1)
            ->get()
            ->toArray()['data'][0]['conversation']['participants'];


        return view('chat.show', compact('messages', 'participants'));
    }

    public function addParticipants(Request $request)
    {
        $conversation_id = (int) $request->conversation_id;

        foreach($request->participants as $participant) {
            $this->chat
                ->conversation(Conversation::find($conversation_id))
                ->addParticipants([User::find($participant)])
                ->makePrivate();
        }

        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->chat->conversation(Conversation::find($id))->removeParticipants(User::find($this->auth->user()->id));

        return redirect()->route('chat.index');
    }

}
