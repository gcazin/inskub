<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Project\ProjectController;
use App\Http\Requests\StoreProject;
use App\Notifications\RequestingExpertise;
use App\Project;
use App\Rating;
use App\RequestExpertise;
use App\User;
use App\UserSkillPivot;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Musonza\Chat\Facades\ChatFacade;

class ExpertController extends Controller
{
    public function index()
    {
        $experts = User::where('id', '<>', auth()->id())->orderBy('created_at')->paginate(8);

        if(\request()->ajax()) {
            $view = [];

            foreach($experts as $user) {
                $view[] = view('components.user-card', compact('user'))->render();
            }

            return response()->json(['html' => $view]);
        }

        return view('expert.index', compact('experts'));
    }

    public function requestExpertise($id)
    {
        $user = User::find($id);

        $expertise = new RequestExpertise();

        $expertise->sender_id = auth()->id();
        $expertise->expert_id = $id;

        $expertise->save();

        $user->notify(new RequestingExpertise($expertise));

        return redirect()->route('index')->with('requestExpertise', 'Votre demande d\'expertise à bien été envoyé');
    }

    public function acceptExpertise($id)
    {
        $notification = auth()->user()->notifications->where('id', $id)[0];

        $notification->markAsRead();

        $participant = $notification->data['sender_id'];

        //Créer le projet
        $request = new StoreProject();

        $title = 'Expertise #' . Str::random(5);

        $request->request->add([
            'title' => $title,
            'description' => 'Projet crée automatiquement',
            'deadline' => Carbon::now()->addDays(7)->format('d/m/Y'),
            'colour' => '#4299e1',
            'private' => 1,
            'type' => 1,
            'user_id' => auth()->id(),
            'created_at' => now(),
            'participants' => [$participant]
        ]);

        (new ProjectController())->store($request);

        $conversation = ChatFacade::createConversation([User::find(auth()->id()), User::find($participant)]);

        $conversation->type_id = 1;

        $conversation->makeDirect();

        $data = ['title' => $title];

        $conversation->update(['data' => $data]);

        return redirect()->route('project.index');

    }

    public function search(Request $request)
    {
        $experts = User::where('role_id', 4)->get();

        if($request->ajax()) {
            $this->validate($request, [
                'skills' => 'required',
            ]);

            $users = [];
            $skills = [];
            $view = [];

            foreach($request->skills as $skill) {
                $skills[] = UserSkillPivot::all()->where('skill_id', '=', $skill);
            }

            foreach(Arr::collapse($skills) as $expert) {
                $users[] = User::find($expert->user_id);
            }

            $experts = collect($users)->unique('id');

            if($request->has('departments')) {
                foreach($request->departments as $department) {
                    $experts = $experts->where('department', '=', $department);
                }
            }

            if($request->has('compagnies')) {
                $experts = $experts->where('company', '=', $request->company);
            }

            foreach($experts as $expert) {
                $view[] = view('components.user-card', compact('expert'))->render();
            }

            return response()->json(['html' => $view]);
        }

        return view('expert.index', compact('experts'));
    }

    public function finishExpertise($id)
    {
        $project = Project::find($id);
        $project->finish = 1;
        $project->update();

        return redirect()->route('project.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param                          $id
     */
    public function ratingExpert(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $expert = User::find($id);

        $rating = new Rating();

        $rating->rating = $request->rating;
        $rating->description =  $request->description ?? null;
        $rating->expert_id = $expert->id;
        $rating->rated_by = auth()->id();

        $rating->save();

        return redirect()->back();
    }
}
