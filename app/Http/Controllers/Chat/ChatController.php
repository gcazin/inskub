<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Musonza\Chat\Chat;
use Musonza\Chat\Models\Conversation;
use Throwable;

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
                ->perPage(10)
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
    public function createDirectConversation($id): RedirectResponse
    {
        $conversation = $this->chat->conversations()->between(User::find($this->auth->id()), User::find($id));

        if($this->auth->id() === (int) $id) {
            return redirect()->back()->with('conversationHimself', 'Vous ne pouvez pas créer de conversation avec vous-même.');
        }

        if($conversation !== null) {
            return redirect()->route('chat.index', $conversation->id);
        }

        $conversation = $this->chat->createConversation([User::find($this->auth->id()), User::find($id)])->makeDirect();

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

        $messages = $this->chat
            ->conversation($this->chat->conversations()->getById($id))
            ->setParticipant($user)
            ->getMessages();

//        if($id !== null) {
//            $participants = $conversation->getById($id)->getParticipants();
//        }

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

    /**
     * Création d'un chat
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     * @throws Throwable
     */
    /*public function store(Request $request)
    {
        if($request->ajax()) {
            $this->talk->setAuthUserId($this->auth->user()->id);

            $rules = [
                'chat-data' => 'required',
                '_id'=>'required'
            ];

            $this->validate($request, $rules);

            $body = $request->input('chat-data');
            $userId = $request->input('_id');

            if ($chat = $this->talk->sendMessageByUserId($userId, $body)) {
                $html = view('chat.ajax.new-chat', compact('chat'))->render();
                return response()->json(['status' => 'success', 'html' => $html], 200);
            }
        }
    }*/

    /**
     * Supprimer un chat
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    /*public function delete(Request $request, $id)
    {
        if ($request->ajax()) {
            if($this->talk->deleteMessage($id)) {
                return response()->json(['status'=>'success'], 200);
            }

            return response()->json(['status'=>'errors', 'msg'=>'something went wrong'], 401);
        }
    }*/

}
