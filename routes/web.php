<?php

use App\Helper\JWTToken;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\Website\Aboutus\AboutItemController;
use App\Http\Controllers\Dashboard\Website\Aboutus\AboutUsController;
use App\Http\Controllers\Homepage\HomepageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("/", [HomepageController::class, "showHomePage"])->name("home.index");
Route::get("/about", [HomepageController::class, "showAboutPage"])->name("home.about");
Route::get("/services", [HomepageController::class, "showServicesPage"])->name("home.service");
Route::get("/pricing", [HomepageController::class, "showPricingPage"])->name("home.pricing");
Route::get("/contact", [HomepageController::class, "showContactPage"])->name("home.contact");







Route::get("/sign-in", [UserController::class, "showLoginPage"])->name("user.login");
Route::get("/send-otp", [UserController::class, "showSendOTPPage"])->name("user.send-otp");
Route::get("/verify-otp", [UserController::class, "showVerifyOTPPage"])->name("user.verify-otp")->middleware("verifyOtpSend");
Route::get("/reset-password", [UserController::class, "showResetPasswordPage"])->name("user.reset-password")->middleware("verifyJwtToken");


// Route::get("/user/register", [UserController::class, "showRegistrationPage"])->name("user.register");




// Login and Registration
// Route::post("/user-registration", [UserController::class, "userRegistration"])->name("register");
Route::post("/user-login", [UserController::class, "logIn"])->name("login");

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
    route::get("/user/details", [ProfileController::class, "userDetails"])->name("user.details");

    Route::post("/profile/info-update", [ProfileController::class, "updateProfileInfo"])->name("profile.update.info");
    // Route::post("/profile/picture-update", [ProfileController::class, "updateProfilePicture"])->name("profile.update.picture");
    // Route::post("/profile/password-update", [ProfileController::class, "UpdatePassword"])->name("profile.update.password");


    Route::prefix("dashboard/website")->group(function () {
        // About Us
        Route::get("/about-us", [AboutUsController::class, "showAboutUsPage"])->name("about-us.index");
        Route::get("/about-us/data", [AboutUsController::class, "aboutUsData"])->name("about-us.data");
        Route::post("/about-us/update", [AboutUsController::class, "updateAboutUs"])->name("about-us.update");

        Route::get("/about-us/item-data", [AboutItemController::class, "getItem"])->name("about-us.item-data");
        Route::post("/about-us/item-create", [AboutItemController::class, "createItem"])->name("about-us.item-create");
        Route::post("/about-us/item-update", [AboutItemController::class, "updateItem"])->name("about-us.item-update");
        Route::post("/about-us/item-delete", [AboutItemController::class, "deleteItem"])->name("about-us.item-delete");
    });

    // Category
    Route::get("/category", [CategoryController::class, "showCategoryPage"])->name("category.index");
    Route::post("/category/create", [CategoryController::class, "store"])->name("category.create");
    Route::get("/category/list", [CategoryController::class, "categoryList"])->name("category.list");
    Route::post("/category/details", [CategoryController::class, "categoryById"])->name("category.details");
    Route::post("/category/update", [CategoryController::class, "updateCategory"])->name("category.update");
    Route::post("/category/delete", [CategoryController::class, "deleteCategory"])->name("category.delete");
});
