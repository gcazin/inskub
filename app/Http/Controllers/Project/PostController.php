<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Post;

class PostController extends Controller
{
    public function show(int $id, int $post_id)
    {
        $post = Post::find($post_id);
        return view('project.post.show', compact('post'));
    }
}
