<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTodo;
use App\Models\Project;
use App\Models\Todo;
use Carbon\Carbon;

class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $project = Project::find($id);
        return view('todo.index', compact('project'));
    }

    public function store(StoreTodo $request)
    {
        $todo = new Todo();
        $todo->title = $request->title;
        $todo->description = $request->description;
        $todo->deadline = Carbon::createFromFormat('d/m/Y', $request->deadline)->format('Y-m-d');
        $todo->user_id = auth()->id();
        $todo->assigned_to = $request->get('assigned_to') ?: auth()->id();
        $todo->project_id = $request->project_id;
        $todo->created_at = now();
        $todo->save();

        return redirect()->back();
    }
}
