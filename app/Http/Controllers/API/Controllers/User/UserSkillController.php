<?php

namespace App\Http\Controllers\API\Controllers\User;

use App\Http\Controllers\API\Controllers\Controller;
use App\UserSkill;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserSkillController extends Controller
{
    /**
     * Permet de créer une compétence de l'utilisateur
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $skill = new UserSkill();
        $skill->title = $request->title;
        $skill->user_id = auth()->id();
        $skill->save();

        return $this->success('La compétence de l\'utilisateur à bien été ajoutée', 200);
    }
}
