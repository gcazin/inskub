<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\UserSkill;
use Illuminate\Http\Request;

class UserSkillController extends Controller
{
    public function store(Request $request)
    {
        $skill = new UserSkill();
        $skill->title = $request->title;
        $skill->user_id = auth()->id();
        $skill->save();

        return redirect()->route('user.profile', auth()->id());
    }
}
