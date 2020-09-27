<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Project\ProjectController;
use App\Http\Requests\StoreProject;
use App\Notifications\RequestingExpertise;
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
        $experts = User::where('role_id', '=', 2)->paginate(20);

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

        return redirect()->route('notification.index');
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

    public function search()
    {
        return view('expert.search');
    }

    public function searchExperts(Request $request)
    {
        $this->validate($request, [
            'skills' => 'required',
        ]);

        $experts = [];
        $skills = [];

        foreach($request->skills as $skill) {
            $skills[] = UserSkillPivot::all()->where('skill_id', '=', $skill);
        }

        foreach(Arr::collapse($skills) as $expert) {
            $experts[] = User::find($expert->user_id);
        }

        $result = collect($experts)->unique('id');

        if($request->has('departments')) {
            foreach($request->departments as $department) {
                $result = $result->where('department', '=', $department);
            }
        }

        if($request->has('company')) {
            $result = $result->where('company', '=', $request->company);
        }

        return view('expert.index', compact('result'));
    }
}
