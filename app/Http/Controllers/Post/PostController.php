<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePost;
use App\Post;
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

    public function store(StorePost $request)
    {
        $post = $this->post;
        $post->content = $request->get('content');
        $post->user_id = auth()->user()->id;
        $post->visibility_id = $request->get('visibility_id');
        if($request->has('media')) {
            $post->media = $request->file('media')->storeAs('posts', Str::random(40).'.'.$request->file('media')->extension(), ['disk' => 'public']);
        }
        $post->save();

        return redirect(route('post.index'));
    }

    public function like($id)
    {
        $post = Post::find($id);
        auth()->user()->toggleLike($post);

        return redirect()->back();
    }
}
