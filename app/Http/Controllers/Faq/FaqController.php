<?php

namespace App\Http\Controllers\Faq;

use App\Faq;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    public function index() {
        $faqs = Faq::all();

        return view('faq.index',compact("faqs"));
    }
}
