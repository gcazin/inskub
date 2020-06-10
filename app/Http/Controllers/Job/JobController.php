<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use App\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $jobs = DB::table('jobs')->orderByDesc('created_at')->simplePaginate(10);

        return view('job.index', compact('jobs'));
    }

    public function create()
    {
        return view('job.create');
    }

    public function show($id)
    {
        $job = Job::find($id);
        return view('job.show', compact('job'));
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
