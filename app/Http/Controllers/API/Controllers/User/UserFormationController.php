<?php

namespace App\Http\Controllers\API\Controllers\User;

use App\Http\Controllers\API\Controllers\Controller;
use App\UserFormation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserFormationController extends Controller
{
    /**
     * Permet de créer une formation de l'utilisateur
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $formation = new UserFormation();
        $formation->school = $request->school;
        $formation->degree = $request->degree;
        $formation->study_area = $request->study_area;
        $formation->start_date = $request->start_date;
        $formation->finish_date = $request->finish_date;
        $formation->description = $request->description ?? null;
        $formation->media = $request->media ?? null;
        $formation->user_id = auth()->id();
        $formation->save();

        return $this->success('La formation de l\'utilisateur à bien été crée.', 200);
    }
}
