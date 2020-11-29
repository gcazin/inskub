<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ReportExpertise;
use App\Models\RequestExpertise;
use App\Models\User;
use App\Notifications\RequestingExpertise;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Musonza\Chat\Chat;
use Musonza\Chat\Facades\ChatFacade;

class RequestExpertiseController extends Controller
{
    /**
     * @var RequestExpertise
     */
    private RequestExpertise $requestExpertise;

    /**
     * @var Chat
     */
    private Chat $chat;

    public function __construct(Chat $chat, RequestExpertise $requestExpertise)
    {
        $this->chat = $chat;
        $this->requestExpertise = $requestExpertise;
    }

    /**
     * Dashboard de l'expert
     */
    public function missions()
    {
        $requests = $this->requestExpertise::where('expert_id', auth()->id())->get();
        $requestExpertise = $this->requestExpertise;

        return view('expert.missions', compact('requests', 'requestExpertise'));
    }

    public function requestExpertise($id, Request $request)
    {
        $user = User::find($id);

        $expertise = new $this->requestExpertise();
        $expertise->description = $request->get('short_description');
        $expertise->sender_id = auth()->id();
        $expertise->expert_id = $id;
        $expertise->save();

        flash()->success('Votre demande d\'expertise à bien été envoyé. L\'expert à 15 jours pour traiter votre demande.');

        $user->notify(new RequestingExpertise($expertise));

        return redirect()->route('sinister.index');
    }

    public function acceptExpertise($id)
    {
        $expertise = $this->requestExpertise::find($id);
        $expertise->status = $this->requestExpertise::ACCEPT_STATUS;

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

        if($this->chat->conversations()->between(User::find(auth()->id()), User::find($sender))) {
            flash()->info("Une conversation existe déjà");
        } else {
            $conversation = ChatFacade::createConversation([User::find(auth()->id()), User::find($sender)]);
            $conversation->type_id = 1;
            $conversation->project_id = $project->id;
            $conversation->makeDirect();
            $data = ['title' => $title];
            $conversation->update(['data' => $data]);
            $expertise->conversation_id = $conversation->id;
        }

        $expertise->update();

        return redirect()->route('project.show', $project->id);
    }

    public function detailedDescriptionExpertise($id, Request $request)
    {
        $expertise = $this->requestExpertise::find($id);
        $expertise->status = $this->requestExpertise::CURRENT_STATUS;
        $expertise->detailed_description = $request->get('detailed_description');
        $expertise->update();

        flash()->success("Votre informations complémentaires ont bien été envoyé.");

        return redirect()->back();
    }

    /**
     * Demande d'informations complémentaires
     *
     * @param $id
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function moreInfoExpertise($id, Request $request)
    {
        $expertise = $this->requestExpertise::find($id);
        $expertise->status = $this->requestExpertise::MORE_INFO_STATUS;
        $expertise->further_information = $request->get('further_information');
        $expertise->update();

        flash()->success("Votre demande d'informations complémentaires a bien été envoyé.");

        return redirect()->back();
    }

    public function refuseExpertise($id, Request $request)
    {
        $expertise = $this->requestExpertise::find($id);

        $expertise->status = $this->requestExpertise::REFUSE_STATUS;
        $expertise->refuse_reason = $request->refuse_reason;
        $expertise->update();

        return redirect()->back();
    }

    public function renewExpertise($id)
    {
        $project = Project::find($id);
        $project->finish = 0;
        $project->update();

        $report = ReportExpertise::firstWhere('project_id', $project->id);
        $report->delete();

        flash()->success("L'expertise a bien été relancé. L'expert en a été informé.");

        return redirect()->route('project.show', $project->id);
    }

    public function finishExpertise($id, Request $request)
    {
        $validated = $request->validate([
            'media' => ['required', 'mimes:pdf'],
        ]);

        $project = Project::find($id);
        $project->finish = 1;
        $project->update();

        $report = new ReportExpertise();
        $report->media = $request->file('media')->store('expertise');
        $report->user_id = auth()->id();
        $report->project_id = $project->id;
        $report->save();

        flash()->success("Votre rapport d'expertise a bien été mise en ligne.");

        return redirect()->route('project.show', $project->id);
    }
}
