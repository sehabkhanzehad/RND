<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Stat;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomepageController extends Controller
{
    public function showHomePage(): View
    {
        $stats = Stat::all();
        $services = Service::all();
        return view("pages.homepage.index", [
            "stats" => $stats,
            "services" => $services,
        ]);
    }

    public function showAboutPage(): View
    {
        $stats = Stat::all();
        $team = Team::all();
        return view("pages.homepage.about-page", [
            "stats" => $stats,
            "team" => $team
        ]);
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

