<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNote;
use App\Note;

class NoteController extends Controller
{
    public function store(StoreNote $request)
    {
        $note = new Note();
        $note->title = $request->title;
        $note->description = $request->description;
        $note->user_id = auth()->id();
        $note->project_id = $request->project_id;
        $note->created_at = now();
        $note->save();

        return redirect()->route('project.todo.index', $request->project_id);
    }
}
