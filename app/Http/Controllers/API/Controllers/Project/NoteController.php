<?php

namespace App\Http\Controllers\API\Controllers\Project;

use App\Http\Controllers\API\Controllers\Controller;
use App\Http\Requests\StoreNote;
use App\Note;
use Illuminate\Http\JsonResponse;

class NoteController extends Controller
{
    /**
     * Permet de voir une note spécifique
     *
     * @param int $note_id
     *
     * @return JsonResponse
     */
    public function show(int $note_id): JsonResponse
    {
        $note = Note::find($note_id);

        return $this->success($note, 200);
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

        return $this->success('La note à bien été ajoutée.', 200);
    }

    public function update(StoreNote $request, $id, $note_id)
    {
        $note = Note::find($note_id);
        $note->title = $request->title;
        $note->description = $request->description;
        $note->save();

        return $this->success('La note '.$note->id.' à bien été modifiée', 200);
    }
}
