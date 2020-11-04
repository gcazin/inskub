<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProject;
use App\Mail\CreatingStudent;
use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Musonza\Chat\Facades\ChatFacade;
use Musonza\Chat\Models\Conversation;

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

        $this->authorize('view', $project);

        $posts = $project->posts->sortByDesc('created_at');

        $conversation = null;
        if (Conversation::where('project_id', $project->id)->exists()) {
            $conversation = Conversation::where('project_id', $project->id)->get()[0]->id;
        }

        /*$user->newSubscription('plans', 'main')->create();

        dd(User::find(10)->subscribed('plans', 'main'));*/

        return view('project.show', compact('project', 'posts', 'conversation'));
    }

    public function edit($id)
    {
        $project = Project::find($id);

        $this->authorize('update', $project);

        return view('project.edit', compact('project'));
    }

    public function update($id, Request $request)
    {
        $project = Project::find($id);

        $this->authorize('update', $project);

        $project->title = $request->title;
        $project->description = $request->description;
        $project->colour = $request->colour;

        $project->update();

        return redirect()->route('project.index');
    }


    public function store(StoreProject $request)
    {
        $project = Project::create($request->validated());

        if($request->filled('participants')) {
            if(auth()->user()->getRoleNames()->contains('school')) {
                $participants = json_decode($request->participants);
                $users = [];

                foreach($participants as $email) {
                    if(User::whereEmail($email->value)->exists()) {
                        return redirect()->back();
                    }
                    $name = trim(explode('@', $email->value)[0]);
                    $plain_password = Str::random(8);
                    $password = Hash::make($plain_password);

                    $user = User::create([
                        'first_name' => $name,
                        'last_name' => $name,
                        'email' => trim($email->value),
                        'password' => $password,
                        'department' => null,
                        'tel' => null,
                        'adresse' => null,
                        'company' => null,
                        'created_at' => now(),
                    ]);
                    $user->assignRole('student');

                    $users[] = User::find($user->id);

                    $project->addParticipant($user->id);

                    Mail::to($user->email)->send(new CreatingStudent($user, $plain_password, $project->id));
                }

                $chat = ChatFacade::createConversation($users);
                $chat->data = ['title' => $project->title];
                $chat->project_id = $project->id;
                $chat->update();
            }

            else {
                foreach ($request->get('participants') as $participant) {
                    $project->addParticipant($participant);
                }

                $participants = collect($request->participants)->map(static function($participant) {
                    return User::find($participant);
                });

                $chat = ChatFacade::createConversation([User::find(auth()->id()), ...$participants]);
                $chat->project_id = $project->id;
                $chat->update();
            }
        }

        return redirect()->route('project.index')->with('project-created', 'Projet crée avec succès');
    }

    public function destroy($id)
    {
        $project = Project::find($id);

        $project->delete();

        return redirect()->route('project.index');
    }
}
