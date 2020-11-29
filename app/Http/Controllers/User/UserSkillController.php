<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserSkillController extends Controller
{
    public function store(Request $request)
    {
        $user = auth()->user();

        foreach($request->skills as $skillId) {
            $user->skills()->attach($skillId);
        }

        return redirect()->route('user.profile', auth()->id());
    }
}
