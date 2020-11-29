<?php

namespace App\Http\Controllers\Formation;

use App\Http\Controllers\Controller;
use App\Models\Formation;
use Illuminate\Http\Request;

class FormationController extends Controller {
    /**
     * @var Formation $formation
     */
    private Formation $formation;

    public function __construct(Formation $formation)
    {
        $this->middleware('auth');
        $this->formation = $formation;
    }

    public function index()
    {
        $formations = Formation::all()->sortByDesc('created_at')->paginate(5);
        return view('formation.index', compact('formations'));
    }

    public function create()
    {
        $formation = $this->formation::all();
        return view('formation.create', compact('formation'));
    }

    public function store(Request $request)
    {
        $formation = new Formation();
        $formation->title = $request->input('title');
        $formation->description = $request->input('description');
        $formation->location = $request->input('location');
        $formation->entry_price = $request->input('entry_price');
        $formation->user_id = auth()->id();
        $formation->save();

        return redirect(route('formation.index'));
    }

    public function show($id)
    {
        $formation = $this->formation::find($id);

        $view = view('formation.show', compact('formation'))->render();

        return response()->json(['html' => $view]);
    }
}
