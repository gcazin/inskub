<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FaqRequest;
use App\Models\Faq;

class FaqController extends Controller
{
    /**
     * @var \App\Models\Faq
     */
    private Faq $faq;

    public function __construct(Faq $faq)
    {
        $this->faq = $faq;
    }

    public function index()
    {
        $faqs = $this->faq::all()->paginate(10);

        return view('admin.faq.index', compact('faqs'));
    }

    public function store(FaqRequest $request)
    {
        $this->faq->create($request->validated());

        return redirect()->route('admin.faq.index');
    }
}
