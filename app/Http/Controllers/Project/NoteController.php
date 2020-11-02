<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNote;
use App\Models\Note;

class NoteController extends Controller
{
    public function show($id, int $note_id)
    {
        $note = Note::find($note_id);
        return view('project.note.show', compact('note'));
    }

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

    public function update(StoreNote $request, $id, $note_id)
    {
        $note = Note::find($note_id);
        $note->title = $request->title;
        $note->description = $request->description;
        $note->save();

        return redirect()->route('project.note.show', ['id' => $note->project_id, 'note_id' => $note->id]);
    }
}
