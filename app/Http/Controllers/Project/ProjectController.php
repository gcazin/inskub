<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProject;
use App\Jobs\SendEmailStudentClassroom;
use App\Models\Classroom;
use App\Models\Professor;
use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Musonza\Chat\Chat;
use Musonza\Chat\Facades\ChatFacade;
use Musonza\Chat\Models\Conversation;

class ProjectController extends Controller
{
    /**
     * @var Project
     */
    private Project $project;

    /**
     * @var Professor
     */
    private Professor $professor;

    /**
     * @var Classroom
     */
    private Classroom $classroom;

    /**
     * @var User
     */
    private User $user;
    /**
     * @var \Musonza\Chat\Chat
     */
    private Chat $chat;

    public function __construct(Project $project, Professor $professor, Classroom $classroom, User $user, Chat $chat)
    {
        $this->project = $project;
        $this->professor = $professor;
        $this->classroom = $classroom;
        $this->user = $user;

        $this->middleware('auth');
        $this->chat = $chat;
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

        $classrooms = $this->professor->where('professor_id', auth()->id())->get()->map(function($classroom) {
            return $classroom->classrooms;
        })->collapse();

        $carbon = new Carbon();

        return view('project.index', compact('projects', 'carbon', 'classrooms'));
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
            $users = [];

            if(auth()->user()->can('classroom.*')) {
                $participants = $request->participants;

                foreach($participants as $participant) {
                    $students = $this->classroom->find($participant)->students;

                    foreach($students as $student) {
                        $users[] = User::find($student->student_id);
                        $project->addParticipant($student->student_id);

                        SendEmailStudentClassroom::dispatch($student, $project, auth()->user());
                    }
                }

                $chat = ChatFacade::createConversation($users);
                $chat->data = ['title' => $project->title];
                $chat->project_id = $project->id;
                $chat->update();
            } else {
                foreach ($request->get('participants') as $participant) {
                    $users[] = User::find($participant);
                    $project->addParticipant($participant);
                }

                $users[] = auth()->user();

                $chat = $this->chat->createConversation($users);
                $chat->project_id = $project->id;
                $chat->save();
            }
        }

        return redirect()->route('project.index')->with('project-created', 'Projet crée avec succès');
    }

    public function updateParticipants(int $id)
    {
        $project = $this->project->find($id);

        /*dd($project->participants->map(function($participant) {
            return $participant->user_id;
        }));*/
    }

    public function destroy($id)
    {
        $project = Project::find($id);

        $project->delete();

        return redirect()->route('project.index');
    }
}
