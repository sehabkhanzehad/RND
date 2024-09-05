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

    public function showAboutPage(): View
    {
        return view("pages.homepage.about-page");
    }

    public function showServicesPage(): View
    {
        return view("pages.homepage.services-page");
    }

    public function showPricingPage(): View
    {
        return view("pages.homepage.pricing-page");
    }

    public function showContactPage(): View
    {
        return view("pages.homepage.contact-page");
    }
}

