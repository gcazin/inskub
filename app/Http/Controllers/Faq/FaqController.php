<?php

namespace App\Http\Controllers\Faq;

use App\Http\Controllers\Controller;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index() {
        $faqs = Faq::all();

        return view('faq.index',compact("faqs"));
    }
}
