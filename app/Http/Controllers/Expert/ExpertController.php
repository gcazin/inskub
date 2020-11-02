<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Rating;
use App\Models\RequestExpertise;
use App\Models\User;
use App\Models\UserSkillPivot;
use App\Notifications\RequestingExpertise;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Musonza\Chat\Facades\ChatFacade;

class ExpertController extends Controller
{
    public function index()
    {
        $experts = User::role('intermediate')->orderBy('created_at')->paginate(8);

        if(\request()->ajax()) {
            $view = [];
            foreach($experts as $user) {
                $view[] = view('components.user.item', compact('user'))->render();
            }

            return response()->json(['html' => $view]);
        }

        return view('expert.index', compact('experts'));
    }

    public function search(Request $request)
    {
        if($request->ajax()) {
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
                    $experts = $experts->where('department_id', '=', $department);
                }
            }

            if($request->filled('companies')) {
                $experts = $experts->where('company_id', '=', $request->company);
            }

            foreach($experts as $user) {
                $view[] = view('components.user.item', compact('user'))->render();
            }

            return response()->json(['html' => $view]);
        }
    }

    public function requestExpertise($id, Request $request)
    {
        $user = User::find($id);

        $expertise = new RequestExpertise();

        $description = collect([$request->get('short_description'), $request->get('detailed_description')]);
        $expertise->description = json_encode($description);
        $expertise->sender_id = auth()->id();
        $expertise->expert_id = $id;
        $expertise->save();

        $user->notify(new RequestingExpertise($expertise));

        return redirect()->route('sinister.index')->with('requestExpertise', 'Votre demande d\'expertise à bien été envoyé');
    }

    public function missions()
    {
        $requests = RequestExpertise::where('expert_id', auth()->id())->get();

        return view('expert.missions', compact('requests'));
    }

    public function acceptExpertise($id)
    {
        $expertise = RequestExpertise::find($id);
        $expertise->status = RequestExpertise::ACCEPT_STATUS;

        $title = 'Expertise #' . Str::random(5);
        $project = Project::create([
            'title' => $title,
            'description' => 'Projet crée automatiquement',
            'deadline' => Carbon::now()->addDays(7)->format('d/m/Y'),
            'colour' => '#4299e1',
            'private' => 1,
            'type' => 1,
            'user_id' => auth()->id(),
            'created_at' => now(),
        ]);

        $sender = $expertise->sender_id;
        $project->addParticipant($sender);

        $expertise->project_id = $project->id;

        $conversation = ChatFacade::createConversation([User::find(auth()->id()), User::find($sender)]);
        $conversation->type_id = 1;
        $conversation->project_id = $project->id;
        $conversation->makeDirect();
        $data = ['title' => $title];
        $conversation->update(['data' => $data]);
        $expertise->conversation_id = $conversation->id;

        $expertise->update();

        return redirect()->route('project.show', $project->id);
    }

    public function refuseExpertise($id, Request $request)
    {
        $expertise = RequestExpertise::find($id);

        $expertise->status = RequestExpertise::REFUSE_STATUS;
        $expertise->refuse_reason = $request->refuse_reason;
        $expertise->update();

        return redirect()->back();
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
