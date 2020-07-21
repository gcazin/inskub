<?php

namespace App\Http\Controllers\API\Controllers\Post;

use App\Http\Controllers\API\Controllers\Controller;
use App\Reply_post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReplyPostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Permet de créer un message sous un post
     *
     * @param Request $request
     * @param $id
     *
     * @return JsonResponse
     */

    public function store(Request $request, $id): JsonResponse
    {
        $reply = new Reply_post();
        $reply->message = $request->input('message');
        $reply->post_id = $id;
        $reply->user_id = auth()->user()->id;
        $reply->save();

        return $this->success('Le message à bien été crée.', 200);
    }
}
