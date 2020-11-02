<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use App\Models\RequestExpertise;

class SinisterController extends Controller
{
    public function index()
    {
        $sinisters = RequestExpertise::where('sender_id', auth()->id())->get();

        return view('sinister.index', compact('sinisters'));
    }
}
