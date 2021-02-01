<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RateExpertController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param                          $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ratingExpert(Request $request, $id): RedirectResponse
    {
        $expert = User::find($id);

        $rating = new Rating();

        $rating->rating = $request->rating;
        $rating->description =  $request->description;
        $rating->expert_id = $expert->id;
        $rating->rated_by = auth()->id();

        $rating->save();

        flash()->success("Merci d'avoir donné un avis sur cette expert !");

        return back();
    }
}
