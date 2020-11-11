<?php


namespace App\Http\Repository;


use App\Models\Post;
use Illuminate\Http\JsonResponse;

class PostRepository
{
    /**
     * Retourne la liste des posts d'un utilisateur
     */
    public function getAllPosts()
    {
        $posts = auth()->user()->posts;
        $posts_followings = auth()->user()->followings->map(static function($user) {
            return Post::where('user_id', $user->id)->where('visibility_id', '<>', 3)->where('project_id', '=', null)->get();
        });

        return $posts->merge($posts_followings->collapse())->sortByDesc('created_at')->paginate(4);
    }

    public function renderComponents(): JsonResponse
    {
        $view = [];

        foreach($this->getAllPosts() as $post) {
            $view[] = view('components.post.item', compact('post'))->render();
        }

        return response()->json(['html' => $view]);
    }

}
