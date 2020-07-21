<?php

namespace App\Http\Controllers\API\Controllers\Formation;

use App\Formation;
use App\Http\Controllers\API\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    /**
     * Retourne la liste de toutes les formations
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $formations = DB::table('formations')->orderByDesc('created_at')->get();

        return $this->success($formations, 200);
    }

    /**
     * Permet de créer une formation
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $formation = new Formation();
        $formation->title = $request->input('title');
        $formation->description = $request->input('description');
        $formation->location = $request->input('location');
        $formation->entry_price = $request->input('entry_price');
        $formation->user_id = auth()->id();
        $formation->save();

        return $this->success('La formation à bien été crée.', 200);
    }

    /**
     * Permet de voir une formation
     *
     * @param $id
     *
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $formation = $this->formation::find($id);

        return $this->success($formation, 200);
    }
}
