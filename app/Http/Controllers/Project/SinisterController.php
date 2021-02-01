<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\ReportExpertise;
use Carbon\Carbon;

class SinisterController extends Controller
{
    public function index()
    {
        $project = auth()->user()->projects->where('type', 1);

        $project_user = ProjectUser::all()->map(static function($user) {
            if($user->user_id === auth()->id()) {
                return Project::where('id', '=', $user->project_id)->where('type', 1)->get();
            }
        });
        $projects = $project->merge($project_user->collapse());

        $carbon = new Carbon();

        return view('project.sinister.index', compact('projects', 'carbon'));
    }

    public function pdfList()
    {
        $reports = ReportExpertise::where('user_id', auth()->id())->get();

        return view('project.sinister.pdf-list', compact('reports'));
    }
}
