<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePost;
use App\Http\Requests\StoreProject;
use App\Post;
use App\Project;
use App\ProjectUser;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        $project = auth()->user()->projects;
        $project_user = ProjectUser::all()->map(static function($user) {
            if($user->user_id === auth()->id()) {
                return Project::where('id', '=', $user->project_id)->get();
            }
        });

        $projects = $project->merge($project_user->collapse());

        $carbon = new Carbon();

        return view('project.index', compact('projects', 'carbon'));
    }

    public function show($id)
    {
        $project = Project::find($id);
        $posts = $project->posts->sortByDesc('created_at');

        $user = auth()->user();

        /*$user->newSubscription('plans', 'main')->create();

        dd(User::find(10)->subscribed('plans', 'main'));*/

        return view('project.show', compact('project', 'posts'));
    }

    public function edit($id)
    {
        $project = Project::find($id);

        return view('project.edit', compact('project'));
    }

    public function update($id, Request $request)
    {
        $project = Project::find($id);
        $project->title = $request->title;
        $project->description = $request->description;
        $project->colour = $request->colour ?? '#4299e1';
        $project->save();

        return redirect()->route('project.index');
    }


    public function store(StoreProject $request)
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

        $participants = collect($request->participants)->map(function($participant) {
            return User::find($participant);
        });

        $participants = [User::find(auth()->id()), ...$participants];

        ChatFacade::createConversation($participants);

        return redirect()->route('project.index')->with('project-created', 'Projet crée avec succès');
    }

    public function storePost(StorePost $request)
    {
        $post = new Post();
        $post->content = $request->get('content');
        $post->user_id = auth()->id();
        $post->visibility_id = $request->get('visibility_id');
        $post->project_id = \request()->id;
        if($request->has('media')) {
            $post->media = $request->file('media')->storeAs('posts', Str::random(40).'.'.$request->file('media')->extension(), ['disk' => 'public']);
        }
        $post->created_at = now();
        $post->save();

        return redirect()->route('project.show', $post->project_id);
    }

    public function destroy($id)
    {
        $project = Project::find($id);

        $project->delete();

        return redirect()->route('project.index');
    }
}
