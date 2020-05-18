<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Post\PostController;
use App\Post;
use App\Project;
use App\ProjectUser;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Musonza\Chat\Facades\ChatFacade;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $projects = auth()->user()->projects;
        $carbon = new Carbon();
        return view('project.index', compact('projects', 'carbon'));
    }

    public function show($id)
    {
        $project = Project::find($id);
        $posts = $project->posts->sortByDesc('created_at');

        return view('project.show', compact('project', 'posts'));
    }

    public function store(Request $request)
    {
        $project = new Project();
        $project->title = $request->title;
        $project->description = $request->description;
        $project->deadline = Carbon::createFromFormat('d/m/Y', $request->deadline)->format('Y-m-d');
        $project->colour = $request->colour ?? '#4299e1';
        $project->private = $request->private;
        $project->user_id = auth()->id();
        $project->created_at = now();
        $project->save();

        if($request->filled('participants')) {
            foreach ($request->participants as $participants) {
                $participant = new ProjectUser();
                $participant->user_id = $participants;
                $participant->project_id = $project->id;
                $participant->created_at = now();
                $participant->save();
            }
        }

        ChatFacade::createConversation([User::find(auth()->id()), User::find($request->participants)]);

        return redirect()->route('project.index')->with('project-created', 'Projet crée avec succès');
    }

    public function storePost(Request $request)
    {
        $post = new Post();
        $post->content = $request->get('content');
        $post->user_id = auth()->id();
        $post->visibility_id = $request->get('visibility_id');
        $post->project_id = $request->get('project_id');
        if($request->filled('media')) {
            $post->media = $request->file('media')->storeAs('posts', Str::random(40).'.'.$request->file('media')->extension(), ['disk' => 'public']);
        }
        $post->created_at = now();
        $post->save();

        return redirect()->route('project.show', $post->project_id);
    }
}
