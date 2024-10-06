<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\Website\Aboutus\AboutItemController;
use App\Http\Controllers\Dashboard\Website\Aboutus\AboutUsController;
use App\Http\Controllers\Dashboard\Website\Aboutus\StatController;
use App\Http\Controllers\Dashboard\Website\Aboutus\TeamController;
use App\Http\Controllers\Dashboard\Website\FaqController;
use App\Http\Controllers\Dashboard\Website\HeroController;
use App\Http\Controllers\Dashboard\Website\LayoutController;
use App\Http\Controllers\Dashboard\Website\ProjectController;
use App\Http\Controllers\Dashboard\Website\Service\FeatureController;
use App\Http\Controllers\Dashboard\Website\Service\ServiceController;
use App\Http\Controllers\Dashboard\Website\TestimonialController;
use App\Http\Controllers\Homepage\HomepageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get("/", [HomepageController::class, "showHomePage"])->name("home.index");
Route::get("/about", [HomepageController::class, "showAboutPage"])->name("home.about");
Route::get("/services", [HomepageController::class, "showServicesPage"])->name("home.service");
Route::get("/pricing", [HomepageController::class, "showPricingPage"])->name("home.pricing");
Route::get("/contact", [HomepageController::class, "showContactPage"])->name("home.contact");
Route::get("/projects", [HomepageController::class, "showProjectPage"])->name("home.project");
Route::get("/project-details/{id}", [HomepageController::class, "showProjectDetails"])->name("home.project-details");

Route::get("/sign-in", [UserController::class, "showLoginPage"])->name("user.login");
Route::get("/send-otp", [UserController::class, "showSendOTPPage"])->name("user.send-otp");
Route::get("/verify-otp", [UserController::class, "showVerifyOTPPage"])->name("user.verify-otp")->middleware("verifyOtpSend");
Route::get("/reset-password", [UserController::class, "showResetPasswordPage"])->name("user.reset-password")->middleware("verifyJwtToken");


// Route::get("/user/register", [UserController::class, "showRegistrationPage"])->name("user.register");




// Login and Registration
// Route::post("/user-registration", [UserController::class, "userRegistration"])->name("register");
Route::post("/user-sign-in", [UserController::class, "logIn"])->name("login");

// Logout
Route::get("/logout", [UserController::class, "userLogout"])->name("user.logout");

// Password Reset
Route::post("/send-otp", [UserController::class, "sendOTP"])->name("send-otp");
Route::post("/otp-verify", [UserController::class, "otpVerify"])->name("verify-otp");
Route::post("/reset-password", [UserController::class, "resetPassword"])->name("reset-password")->middleware("verifyJwtToken");


Route::middleware("authCheck")->group(function () {
    // Dashboard
    Route::get("/dashboard", [DashboardController::class, "showDashboardPage"])->name("dashboard");

    // Profile
    Route::get("/edit-profile", [ProfileController::class, "showProfilePage"])->name("user.profile");
    route::get("/profile-details", [ProfileController::class, "userDetails"])->name("user.details");

    Route::post("/profile/info-update", [ProfileController::class, "updateProfileInfo"])->name("profile.update.info");
    // Route::post("/profile/picture-update", [ProfileController::class, "updateProfilePicture"])->name("profile.update.picture");
    // Route::post("/profile/password-update", [ProfileController::class, "UpdatePassword"])->name("profile.update.password");


    Route::prefix("/dashboard/website")->group(function () {
        // About
        Route::get("/about-us", [AboutUsController::class, "showAboutUsPage"])->name("about-us.index");
        Route::get("/about-us/data", [AboutUsController::class, "aboutUsData"])->name("about-us.data");
        Route::post("/about-us/update", [AboutUsController::class, "updateAboutUs"])->name("about-us.update");

        // About Item
        Route::get("/about-us/item-data", [AboutItemController::class, "getItem"])->name("about-us.item-data");
        Route::get("/about-us/item-id", [AboutItemController::class, "itemById"])->name("about-us.item-id");
        Route::post("/about-us/item-create", [AboutItemController::class, "createItem"])->name("about-us.item-create");
        Route::post("/about-us/item-update", [AboutItemController::class, "updateItem"])->name("about-us.item-update");
        Route::post("/about-us/item-delete", [AboutItemController::class, "deleteItem"])->name("about-us.item-delete");

        // Stats
        Route::get("/stats", [StatController::class, "showStatPage"])->name("stats.index");
        Route::get("/stat-id", [StatController::class, "statById"])->name("stat.id");
        Route::get("/stat-data", [StatController::class, "statData"])->name("stats.data");
        Route::post("/stat-create", [StatController::class, "createStat"])->name("stat.create");
        Route::post("/stat-update", [StatController::class, "updateStat"])->name("stat.update");
        Route::post("/stat-delete", [StatController::class, "deleteStat"])->name("stat.delete");

        // Team
        Route::get("/team", [TeamController::class, "showTeamPage"])->name("team.index");
        Route::get("/team-id", [TeamController::class, "teamById"])->name("team.id");
        Route::get("/team-data", [TeamController::class, "teamData"])->name("team.data");
        Route::post("/team-create", [TeamController::class, "createTeam"])->name("team.create");
        Route::post("/team-update", [TeamController::class, "updateTeam"])->name("team.update");
        Route::post("/team-delete", [TeamController::class, "deleteTeam"])->name("team.delete");

        // Service
        Route::get("/service", [ServiceController::class, "showServicePage"])->name("service.index");
        Route::get("/service-id", [ServiceController::class, "serviceById"])->name("service.id");
        Route::get("/service-data", [ServiceController::class, "serviceData"])->name("service.data");
        Route::post("/service-create", [ServiceController::class, "createService"])->name("service.create");
        Route::post("/service-update", [ServiceController::class, "updateService"])->name("service.update");
        Route::post("/service-delete", [ServiceController::class, "deleteService"])->name("service.delete");

        // Projects
        Route::get("/projects", [ProjectController::class, "showProjectPage"])->name("project.index");
        Route::get("/project-id", [ProjectController::class, "projectById"])->name("project.id");
        Route::get("/project-data", [ProjectController::class, "projectData"])->name("project.data");
        Route::post("/project-create", [ProjectController::class, "createProject"])->name("project.create");
        Route::post("/project-update", [ProjectController::class, "updateProject"])->name("project.update");
        Route::post("/project-delete", [ProjectController::class, "deleteProject"])->name("project.delete");



        // Feature
        Route::get("/features", [FeatureController::class, "showFeaturePage"])->name("feature.index");
        Route::get("/feature-id", [FeatureController::class, "featureById"])->name("feature.id");
        Route::get("/feature-data", [FeatureController::class, "featureData"])->name("feature.data");
        Route::post("/feature-create", [FeatureController::class, "createFeature"])->name("feature.create");
        Route::post("/feature-update", [FeatureController::class, "updateFeature"])->name("feature.update");
        Route::post("/feature-delete", [FeatureController::class, "deleteFeature"])->name("feature.delete");

        // Testimonial
        Route::get("/testimonial", [TestimonialController::class, "showTestimonialPage"])->name("testimonial.index");
        Route::get("/testimonial-id", [TestimonialController::class, "testimonialById"])->name("testimonial.id");
        Route::get("/testimonial-data", [TestimonialController::class, "testimonialData"])->name("testimonial.data");
        Route::post("/testimonial-create", [TestimonialController::class, "createTestimonial"])->name("testimonial.create");
        Route::post("/testimonial-update", [TestimonialController::class, "updateTestimonial"])->name("testimonial.update");
        Route::post("/testimonial-delete", [TestimonialController::class, "deleteTestimonial"])->name("testimonial.delete");

        // FAQ
        Route::get("/faq", [FaqController::class, "showFaqPage"])->name("faq.index");
        Route::get("/faq-id", [FaqController::class, "faqById"])->name("faq.id");
        Route::get("/faq-data", [FaqController::class, "faqData"])->name("faq.data");
        Route::post("/faq-create", [FaqController::class, "createFaq"])->name("faq.create");
        Route::post("/faq-update", [FaqController::class, "updateFaq"])->name("faq.update");
        Route::post("/faq-delete", [FaqController::class, "deleteFaq"])->name("faq.delete");

        // Layout
        Route::get("/layout", [LayoutController::class, "showLayoutPage"])->name("layout.index");
        Route::get("/layout-data", [LayoutController::class, "layoutData"])->name("layout.data");
        Route::post("/layout-social", [LayoutController::class, "socialUpdate"])->name("layout.social");
        Route::post("/layout-favicon", [LayoutController::class, "faviconUpdate"])->name("layout.favicon");
        Route::post("/layout-footer", [LayoutController::class, "footerUpdate"])->name("layout.footer");
        Route::post("/layout-header", [LayoutController::class, "headerLogoUpdate"])->name("layout.header");

        // Contact
        Route::get("/contact", [LayoutController::class, "showContactPage"])->name("contact.index");
        Route::get("/contact-data", [LayoutController::class, "contactData"])->name("contact.data");
        Route::post("/contact-update", [LayoutController::class, "updateContact"])->name("contact.update");

        // Hero
        Route::get("/hero", [HeroController::class, "showHeroPage"])->name("hero.index");
        Route::get("/hero-data", [HeroController::class, "heroData"])->name("hero.data");
        Route::post("/hero-background", [HeroController::class, "updateBackground"])->name("hero.background");
        Route::post("/hero-content", [HeroController::class, "updateContent"])->name("hero.content");
    });
});
