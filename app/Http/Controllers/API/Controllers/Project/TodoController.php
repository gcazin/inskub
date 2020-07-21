<?php

namespace App\Http\Controllers\API\Controllers\Project;

use App\Http\Controllers\API\Controllers\Controller;
use App\Http\Requests\StoreTodo;
use App\Project;
use App\Todo;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class TodoController extends Controller
{
    public function index($id)
    {
        $project = Project::find($id);

        return $this->success($project, 200);
    }

    /**
     * Permet de créer une tâche dans l'espace projet
     *
     * @param StoreTodo $request
     *
     * @return JsonResponse
     */
    public function store(StoreTodo $request): JsonResponse
    {
        $todo = new Todo();
        $todo->title = $request->title;
        $todo->description = $request->description;
        $todo->deadline = Carbon::createFromFormat('d/m/Y', $request->deadline)->format('Y-m-d');
        $todo->user_id = auth()->id();
        $todo->assigned_to = $request->assigned_to;
        $todo->project_id = $request->project_id;
        $todo->created_at = now();
        $todo->save();

        return $this->success('La tâche à bien été ajoutée', 200);
    }
}
