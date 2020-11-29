<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Repository\PostRepository;
use App\Http\Requests\StorePost;
use App\Models\Post;
use App\Models\ReportPost;
use App\Models\User;
use App\Notifications\ReportingPost;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{

    /**
     * @var Post $post
     */
    private Post $post;

    /**
     * @var PostRepository
     */
    private PostRepository $postRepository;

    public function __construct(Post $post, PostRepository $postRepository)
    {
        $this->middleware('auth');
        $this->post = $post;
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $posts = $this->postRepository->getAllPosts();

        if(\request()->ajax()) {
            return $this->postRepository->renderComponents();
        }

        return view('index', compact('posts'));
    }

    public function show(int $id)
    {
        $this->middleware('guest');

        $post = $this->post::all()->find($id);

        return view('post.show', compact('post'));
    }

    /**
     * Créer une publication
     *
     * @param StorePost $request
     *
     * @return JsonResponse
     */
    public function store(StorePost $request): JsonResponse
    {
        $post = new $this->post;
        $post->content = $request->get('content');
        $post->user_id = auth()->id();
        $post->visibility_id = $request->get('visibility_id');
        $post->project_id = $request->get('project_id');
        $post->media = $request->has('media') ? $request->file('media')->store('posts') : null;
        $post->created_at = now();
        $post->save();

        $animate = true;

        $html = view('components.post.item', compact('post', 'animate'))->render();

        return response()->json($html);
    }

    public function edit($id)
    {
        $post = $this->post->find($id);

        return view('post.edit', compact('post'));
    }

    public function update($id, StorePost $request)
    {
        $post = $this->post->find($id);
        $post->content = $request->get('content');
        $post->user_id = auth()->id();
        $post->visibility_id = $request->get('visibility_id') ?? $post->visibility_id;
        $post->project_id = $request->get('project_id') ?? $post->project_id;
        $post->media = $request->has('media') ? $request->file('media')->store('posts') : $post->media;
        $post->updated_at = now();
        $post->update();

        return redirect()->route('post.show', $post);
    }

    public function like($id)
    {
        $post = $this->post->find($id);

        auth()->user()->toggleLike($post);

        return back();
    }

    public function destroy($id)
    {
        $post = $this->post->find($id);

        $post->delete();

        return back();
    }

    public function report(Request $request, $id)
    {
        $report = new ReportPost();
        $report->reason_id = $request->reason_id;
        $report->informant_id = auth()->id();
        $report->post_id = $id;
        $report->save();

        $users = User::role('super-admin')->get();

        foreach($users as $user) {
            $user->notify(new ReportingPost($report));
        }

        return back();
    }
}
