<?php

namespace App\Http\Controllers\Formation;

use App\Formation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FormationController extends Controller
{
    /**
     * @var Formation $formation
     */
    private Formation $formation;

    public function __construct(Formation $formation)
    {
        $this->formation = $formation;
    }

    public function create()
    {
        $formation = $this->formation::all();
        return view('formation.create-formation', compact('formation'));
    }

    public function store(Request $request)
    {
        $formation = new Formation();
        $formation->title = $request->input('title');
        $formation->description = $request->input('description');
        $formation->location = $request->input('location');
        $formation->entry_price = $request->input('entry_price');
        $formation->user_id = \auth()->user()->id;
        $formation->save();

        return redirect(route('create.formation'));
    }

    public function show()
    {
        $formation = $this->formation::all();
        return view('formation.show-formation', compact('formation'));
    }
}
