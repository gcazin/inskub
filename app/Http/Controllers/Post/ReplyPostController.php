<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Reply_post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class ReplyPostController extends Controller
{
    /**
     * id, chat, post_id, user_id
     * @param Request $request
     * @param $id
     * @return RedirectResponse|Redirector
     */

    public function store(Request $request, $id)
    {
        $reply = new Reply_post();
        $reply->message = $request->input('message');
        $reply->post_id = $id;
        $reply->user_id = auth()->user()->id;
        $reply->save();

        return redirect(route('post.show', $id));
    }
}
