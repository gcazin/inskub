<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserFormation;
use Illuminate\Http\Request;

class UserFormationController extends Controller
{
    public function create()
    {
        return view('user.formation.create');
    }

    public function store(Request $request)
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

        return redirect()->route('user.profile', auth()->id());
    }
}
