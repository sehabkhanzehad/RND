<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\AboutItem;
use App\Models\AboutUs;
use App\Models\Contact;
use App\Models\Faq;
use App\Models\Feature;
use App\Models\Hero;
use App\Models\Layout;
use App\Models\Service;
use App\Models\Stat;
use App\Models\Team;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomepageController extends Controller
{
    public function showHomePage(): View
    {
        $layout = Layout::first();
        $aboutUs = AboutUs::first();
        $aboutItems = AboutItem::all();
        $stats = Stat::all();
        $services = Service::all();
        return view("pages.homepage.index", [
            "hero" => Hero::first(),
            "layout" => $layout,
            "aboutUs" => $aboutUs,
            "aboutItems" => $aboutItems,
            "stats" => $stats,
            "services" => $services,
            "testimonials" => Testimonial::all(),
            "faqs" => Faq::all(),
            "contacts" => Contact::first(),
            "features" => Feature::all(),
        ]);
    }

    public function showAboutPage(): View
    {
        $aboutUs = AboutUs::first();
        $aboutItems = AboutItem::all();
        $stats = Stat::all();
        $team = Team::all();
        return view("pages.homepage.about-page", [
            "aboutUs" => $aboutUs,
            "aboutItems" => $aboutItems,
            "stats" => $stats,
            "team" => $team,
            "testimonials" => Testimonial::all(),
            "contacts" => Contact::first(),
        ]);
    }

    public function showServicesPage(): View
    {
        $services = Service::all();
        return view("pages.homepage.services-page", [
            "services" => $services,
            "testimonials" => Testimonial::all(),
            "faqs" => Faq::all(),
            "contacts" => Contact::first(),
            "features" => Feature::all(),
        ]);
    }

    public function showPricingPage(): View
    {
        return view("pages.homepage.pricing-page", [
            "contacts" => Contact::first(),
        ]);
    }

    public function showContactPage(): View
    {
        return view("pages.homepage.contact-page", [
            "contacts" => Contact::first(),
        ]);
    }
}
