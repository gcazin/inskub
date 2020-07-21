<?php

namespace App\Http\Controllers\API\Controllers\Chat;

use App\Http\Controllers\API\Controllers\Controller;
use App\User;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Musonza\Chat\Chat;
use Musonza\Chat\Models\Conversation;

class ChatController extends Controller
{

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
     * Liste toutes les conversations de l'utilisateur
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        $conversations = $this->chat->conversations()
            ->setPaginationParams(['sorting' => 'desc'])
            ->setParticipant($this->auth->user())
            ->isPrivate()
            ->perPage(10)
            ->get();

        return $this->success($conversations);
    }

    /**
     * Conversation entre deux personnes
     *
     * @param $id
     *
     * @return JsonResponse
     * @throws \Musonza\Chat\Exceptions\DirectMessagingExistsException
     * @throws \Musonza\Chat\Exceptions\InvalidDirectMessageNumberOfParticipants
     */
    public function createDirectConversation($id): JsonResponse
    {
        $conversation = $this->chat->conversations()->between(User::find($this->auth->id()), User::find($id));

        if($this->auth->id() === (int) $id) {
            return $this->error( 'Vous ne pouvez pas créer de conversation avec vous-même.', 400);
        }

        if($conversation !== null) {
            return $this->error( 'La conversation existe déjà.', 404);
        }

        $conversation = $this->chat->createConversation([User::find($this->auth->id()), User::find($id)])->makeDirect();

        return $this->success($conversation->id, 201);
    }

    /**
     * Conversation de groupes à plus de deux utilisateurs
     *
     * @return JsonResponse
     */
    public function createGroupConversation(): JsonResponse
    {
        $conversation = $this->chat->createConversation([User::find($this->auth->id()), User::find(2), User::find(3), User::find(4)]);

        return $this->success($conversation, 201);
    }

    /**
     * Retourne les données d'une conversation
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $user = User::find($this->auth->user()->id);

        $messages = $this->chat
            ->conversation($this->chat->conversations()->getById($id))
            ->setParticipant($user)
            ->getMessages();

        $participants = $this->chat->conversations()->setPaginationParams(['sorting' => 'desc'])
            ->setParticipant($user)
            ->limit(1)
            ->page(1)
            ->get()
            ->toArray()['data'][0]['conversation']['participants'];

        return $this->success([$messages, $participants]);
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

        return $this->success('Les participants ont bien été ajoutées.', 201);
    }

}
