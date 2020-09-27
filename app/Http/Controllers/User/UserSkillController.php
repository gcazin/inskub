<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\UserSkillPivot;
use Illuminate\Http\Request;

class UserSkillController extends Controller
{
    public function store(Request $request)
    {
        foreach($request->skills as $skill_id) {
            $skill = new UserSkillPivot();
            $skill->skill_id = $skill_id;
            $skill->user_id = auth()->id();
            $skill->save();
        }

        return redirect()->route('user.profile', auth()->id());
    }
}
