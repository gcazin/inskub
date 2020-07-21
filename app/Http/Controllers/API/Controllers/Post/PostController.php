<?php

namespace App\Http\Controllers\API\Controllers\Post;

use App\Http\Controllers\API\Controllers\Controller;
use App\Http\Requests\StorePost;
use App\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * @var Post $post
     */
    private Post $post;

    public function __construct(Post $post)
    {
        $this->middleware('auth');
        $this->post = $post;
    }

    /**
     * Permet de voir un post spécifique
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $post = Post::all()->find($id);

        return $this->success($post, 200);
    }

    /**
     * @param StorePost $request
     *
     * @return JsonResponse
     */
    public function store(StorePost $request): JsonResponse
    {
        $post = $this->post;
        $post->content = $request->get('content');
        $post->user_id = auth()->id();
        $post->visibility_id = $request->get('visibility_id');
        if($request->has('project_id')) {
            $post->project_id = $request->get('project_id');
        }
        if($request->has('media')) {
            $post->media = $request->file('media')
                ->storeAs('posts', Str::random(40).'.'.$request->file('media')->extension(), ['disk' => 'public']);
        }

        $post->created_at = now();
        $post->save();

        return $this->success('Le post à bien été crée.', 200);
    }

    public function like($id)
    {
        $post = Post::find($id);
        auth()->user()->toggleLike($post);

        return $this->success('Publication likée', 200);
    }
}
