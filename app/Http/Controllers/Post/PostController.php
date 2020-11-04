<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePost;
use App\Models\Post;
use App\Models\ReportPost;
use App\Models\User;
use App\Notifications\ReportingPost;
use Illuminate\Http\Request;
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
     * Show the application dashboard.
     *
     */
    public function index()
    {
        $posts = User::find(auth()->id())->posts;

        $posts_followings = User::find(auth()->id())->followings->map(static function($user) {
            return Post::where('user_id', $user->id)->where('visibility_id', '<>', 3)->where('project_id', '=', null)->get();
        });

        $posts = $posts->merge($posts_followings->collapse())->sortByDesc('created_at')->paginate(4);

        if(\request()->ajax()) {
            $view = [];

            foreach($posts as $post) {
                $view[] = view('components.post', compact('post'))->render();
            }

            return response()->json(['html' => $view]);
        }

        return view('index', compact('posts'));
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
        $post->project_id = $request->get('project_id') ?? null;

        if($request->has('media')) {
            $post->media = $request->file('media')->storeAs('posts',Str::random(40).'.'.$request->file('media')->extension(), ['disk' => 'public']);
        }

        $post->created_at = now();
        $post->save();

        $animate = true;

        $html = view('components.post.item', compact('post', 'animate'))->render();

        return response()->json($html);
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
        $post->visibility_id = $request->get('visibility_id') ?? null;
        $post->project_id = $request->get('project_id') ?? null;
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

    public function report(Request $request, $id)
    {
        $report = new ReportPost();
        $report->reason_id = $request->reason_id;
        $report->informant_id = auth()->id();
        $report->post_id = $id;
        $report->save();

        $user = \App\User::where('role_id', '=', 1)->first();

        $user->notify(new ReportingPost($report));

        return redirect()->back()->with('thanks_report', 'Merci pour votre signalement, nous allons traiter votre demande');
    }
}
