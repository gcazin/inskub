<?php

namespace App\Http\Controllers\API\Controllers\Project;

use App\Http\Controllers\API\Controllers\Controller;
use App\Http\Requests\StorePost;
use App\Http\Requests\StoreProject;
use App\Post;
use App\Project;
use App\ProjectUser;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
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

        return $this->success($projects, 200);
    }

    public function show($id)
    {
        $project = Project::find($id);
        $posts = $project->posts->sortByDesc('created_at');

        return $this->success([
            'project' => $project,
            'posts' => $posts
        ], 200);
    }

    /**
     * Permet de créer un projet
     *
     * @param StoreProject $request
     *
     * @return JsonResponse
     */
    public function store(StoreProject $request): JsonResponse
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

        return $this->success('Projet crée avec succès.', 200);
    }

    /**
     * Permet de créer un post dans l'espace projet
     *
     * @param StorePost $request
     *
     * @return JsonResponse
     */
    public function storePost(StorePost $request): JsonResponse
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

        return $this->success('La publication à bien été créee.', 200);
    }
}
