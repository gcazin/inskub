<?php

namespace App\Http\Controllers\API\Controllers\Project;

use App\Http\Controllers\API\Controllers\Controller;
use App\Post;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    /**
     * Retourne le détail d'un post
     *
     * @param int $post_id
     *
     * @return JsonResponse
     */
    public function show(int $post_id): JsonResponse
    {
        $post = Post::find($post_id);

        return $this->success($post, 200);
    }
}
