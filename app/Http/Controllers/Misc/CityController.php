<?php

namespace App\Http\Controllers\Misc;

use App\Http\Controllers\Controller;
use App\Models\City;

class CityController extends Controller
{
    public function cities(string $postal_code) {
        $cities = City::where('zip_code', $postal_code)->get();

        return response()->json(['html' => $cities]);
    }
}
