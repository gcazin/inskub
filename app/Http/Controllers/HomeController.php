<?php

namespace App\Http\Controllers;

use Spatie\Sitemap\SitemapGenerator;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function welcome()
    {
        return view('welcome');
    }
}
