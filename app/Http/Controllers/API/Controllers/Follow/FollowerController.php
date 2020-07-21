<?php

namespace App\Http\Controllers\API\Controllers\Follow;

use App\Http\Controllers\API\Controllers\Controller;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    /**
     * Retourne les données
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function add(Request $request): JsonResponse
    {
        $user = User::find(auth()->user()->id);

        $user->toggleFollow($request->get('user_id'));

        return response()->json('J\'aime ajouté');
    }

}
