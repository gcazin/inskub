<?php

namespace App\Http\Controllers\API\Controllers\Auth;

use App\Http\Controllers\API\Controllers\Controller;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Inscription de l'utilisateur
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'role_id' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'first_name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'department' => ['integer'],
            'tel' => [''],
            'adresse' => [''],
        ]);

        if(!$validatedData) {
            return $this->error('Manque des champs', 400);
        }

        $validatedData['password'] = bcrypt($request->password);

        $user = User::create($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;

        return $this->success([ 'user' => $user, 'access_token' => $accessToken], 201);
    }

    /**
     * Connexion de l'utilisateur
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return $this->error('Mauvaise combinaison email/mot de passe.', 400);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return $this->success([
            'user' => auth()->user(),
            'access_token' => $accessToken
        ]);
    }
}
