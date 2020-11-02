<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserExperience;
use Illuminate\Http\Request;

class UserExperienceController extends Controller
{
    public function create()
    {
        return view('user.experience.create');
    }

    public function store(Request $request)
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

        return redirect()->route('user.profile', auth()->id());
    }
}
