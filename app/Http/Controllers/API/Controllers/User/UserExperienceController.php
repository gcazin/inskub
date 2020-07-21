<?php

namespace App\Http\Controllers\API\Controllers\User;

use App\Http\Controllers\API\Controllers\Controller;
use App\UserExperience;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserExperienceController extends Controller
{
    /**
     * Permet de créer une expérience de l'utilisateur
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $experience = new UserExperience();
        $experience->title = $request->title;
        $experience->enterprise = $request->enterprise;
        $experience->location = $request->location;
        $experience->start_date = $request->start_date;
        $experience->finish_date = $request->finish_date;
        $experience->sector = $request->sector;
        $experience->description = $request->description ?? null;
        $experience->media = $request->media ?? null;
        $experience->user_id = auth()->id();
        $experience->save();

        return $this->success('L\'expérience à bien été crée.', 200);
    }
}
