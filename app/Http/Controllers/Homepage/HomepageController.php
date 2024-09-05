<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomepageController extends Controller
{
    public function showHomePage(): View
    {
        return view("pages.homepage.index");
    }
}

