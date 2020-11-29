<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * @var Job
     */
    private Job $job;

    public function __construct(Job $job)
    {
        $this->middleware('auth');
        $this->job = $job;
    }

    public function index()
    {
        $jobs = Job::all()->sortByDesc('created_at')->paginate(10);

        return view('job.index', compact('jobs'));
    }

    public function create()
    {
        return view('job.create');
    }

    public function show($id)
    {
        $job = $this->job::find($id);

        $view = view('job.show', compact('job'))->render();

        return response()->json(['html' => $view]);
    }

    public function store(Request $request)
    {
        $job = new Job();
        $job->title = $request->get('title');
        $job->description = $request->get('description');
        $job->hours = $request->get('hours');
        $job->salary = $request->get('salary');
        $job->type_id = $request->get('type_id');
        $job->user_id = auth()->id();
        $job->created_at = now();
        $job->save();

        return view('job.index');
    }
}
