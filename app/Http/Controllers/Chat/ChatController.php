<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\ValidationException;
use Musonza\Chat\Chat;
use Musonza\Chat\Facades\ChatFacade;
use Musonza\Chat\Http\Controllers\ConversationController;
use Musonza\Chat\Models\Conversation;
use phpDocumentor\Reflection\Types\Integer;
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
    }

    /**
     * Index de la messagerie privée
     *
     * @return Factory|View
     */
    public function index()
    {
        $conversations = $this->chat
            ->conversations()
            ->setParticipant($this->user->find($this->auth->user()->id))
            ->get()
            ->toArray()['data'];

        $conversations = Arr::pluck($conversations, 'conversation');

        foreach($conversations as $conversation) {
            $inbox[] = $conversation['id']; // Récupération des id de conversations
        }

        $user = User::all();

        return view('chat.index', compact('inbox', 'user'));
    }

    /**
     * Conversation
     *
     * @param int $id
     *
     * @return Factory|\Illuminate\View\View
     *
     * TODO: Cet enfer est à finir
     */
    public function chat(int $id)
    {
        $user = $this->user->find($this->auth->user()->id);

        $messages = $this->chat
            ->conversation($this->chat->conversations()->getById($id))
            ->setParticipant($user)
            ->getMessages()
            ->toArray()['data'];

        $participant_query = $this->chat
            ->conversations()
            ->setPaginationParams(['sorting' => 'desc'])
            ->setParticipant($user)
            ->get()
            ->toArray()['data'];

        $participants_explode = Arr::pluck(Arr::pluck($participant_query, 'conversation'), 'participants')[0];

        foreach($participants_explode as $participant) {
            $participants[] = $participant['messageable_id'];
        }

        return view('chat.conversation', compact('messages', 'participants'));
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
