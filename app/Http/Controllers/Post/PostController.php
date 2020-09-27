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
        $this->post = $post;
    }

    public function show(int $id)
    {
        $this->middleware('guest');
        $post = Post::all()->find($id);
        return view('post.show', compact('post'));
    }

    /**
     * Créer une publication
     *
     * @param \App\Http\Requests\StorePost $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StorePost $request)
    {
        $post = $this->post;
        $post->content = $request->get('content');
        $post->user_id = auth()->id();
        $post->visibility_id = $request->get('visibility_id');
        if($request->has('project_id')) {
            $post->project_id = $request->get('project_id');
        }
        if($request->has('media')) {
            $post->media = $request->file('media')->storeAs('posts', Str::random(40).'.'.$request->file('media')->extension(), ['disk' => 'public']);
        }

        $post->created_at = now();
        $post->save();

        return redirect(route('index'));
    }

    /**
     * Page pour modifier une publication
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $post = $this->post->find($id);

        return view('post.edit', compact('post'));
    }

    /**
     * Mettre à jour une publication
     *
     * @param int                          $id
     * @param \App\Http\Requests\StorePost $request
     */
    public function update($id, StorePost $request)
    {
        $post = $this->post->find($id);
        $post->content = $request->get('content');
        $post->user_id = auth()->id();
        $post->visibility_id = $request->get('visibility_id');
        if($request->has('project_id')) {
            $post->project_id = $request->get('project_id');
        }
        if($request->has('media')) {
            $post->media = $request->file('media')->storeAs('posts', Str::random(40).'.'.$request->file('media')->extension(), ['disk' => 'public']);
        }

        $post->updated_at = now();
        $post->update();

        return redirect()->route('post.show', $post);
    }

    public function like($id)
    {
        $post = Post::find($id);
        auth()->user()->toggleLike($post);

        return redirect()->back();
    }

    public function destroy($id)
    {
        $post = $this->post->find($id);

        $post->delete();

        return redirect()->back();
    }
}
