<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use App\Models\RequestExpertise;

class SinisterController extends Controller
{
    public function index(?string $status = null)
    {
        $requestExpertise = RequestExpertise::class;

        $sinisters = RequestExpertise::where('sender_id', auth()->id())->get();

        if($status !== null) {
            $status = request()->status;

            switch($status) {
                case 0:
                    $sinisters->where('status', RequestExpertise::CURRENT_STATUS)->orWhere('status', RequestExpertise::MORE_INFO_STATUS)->get();
                    break;
                case 1:
                    $sinisters->where('status', RequestExpertise::ACCEPT_STATUS)->get();
                    break;
                case 2:
                    $sinisters->where('status', RequestExpertise::REFUSE_STATUS)->get();
                    break;
            }
        }

        return view('sinister.index', compact('sinisters'));
    }
}
