<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function index()
    {
        $posts = $this->post::all();
        return view('post.index', compact('posts'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function show(int $id)
    {
        $post = Post::all()->find($id);
        return view('post.show', compact('post'));
    }

    public function store(Request $request)
    {
        $post = $this->post;
        $post->content = $request->get('content');
        $post->user_id = auth()->user()->id;
        $post->visibility_id = $request->get('visibility_id');
        $post->save();

        return redirect(route('index'));
    }

    public function like($id)
    {
        $post = Post::find($id);
        auth()->user()->toggleLike($post);

        return redirect()->back();
    }
}
