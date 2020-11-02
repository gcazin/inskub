<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FaqRequest;
use App\Models\Faq;
use Illuminate\Support\Facades\DB;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = DB::table('faq')->paginate(10);

        return view('admin.faq.index', compact('faqs'));
    }

    public function store(FaqRequest $request)
    {
        Faq::create($request->validated());

        return redirect()->route('admin.faq.index');
    }
}
