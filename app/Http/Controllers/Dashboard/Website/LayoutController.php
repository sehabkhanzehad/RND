<?php

namespace App\Http\Controllers\Dashboard\Website;

use App\Http\Controllers\Controller;
use App\Models\Layout;
use Illuminate\Http\Request;

class LayoutController extends Controller
{
    public function showLayoutPage()
    {
        return view("pages.dashboard.website.layout-page");
    }

    public function socialUpdate(Request $request)
    {
        try {
            $facebbokLink = $request->input("facebook_link");
            $twitterLink = $request->input("twitter_link");
            $instagramLink = $request->input("instagram_link");
            $linkedinLink = $request->input("linkedin_link");
            $whatsappLink = $request->input("whatsapp_link");

            Layout::first()->update([
                "facebook_link" => $facebbokLink,
                "twitter_link" => $twitterLink,
                "instagram_link" => $instagramLink,
                "linkedin_link" => $linkedinLink,
                "whatsapp_link" => $whatsappLink
            ]);
            return response()->json([
                "status" => "success",
                "message" => "Updated successfully",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => "failed",
                "message" => "Something went wrong",
                "error" => $th->getMessage(),
            ]);
        }
    }

    public function headerLogoUpdate(Request $request)
    {
        try {
            if ($request->hasFile("header_logo")) {
                $headerLogo = $request->file("header_logo");

                if ($headerLogo->getClientOriginalExtension() != "jpg" && $headerLogo->getClientOriginalExtension() != "png" && $headerLogo->getClientOriginalExtension() != "jpeg") {
                    return response()->json([
                        "status" => "failed",
                        "message" => "Please select a JPG, JPEG or PNG logo",
                    ]);
                } else {
                    // Delete Old Logo
                    $oldHeaderLogo = Layout::first()->header_logo;
                    unlink(public_path($oldHeaderLogo));

                    $headerLogoName = uniqid() . "_header_logo" . "." . $headerLogo->getClientOriginalExtension();
                    $headerLogo->move(public_path('uploads/layout/'), $headerLogoName);
                    $headerLogoLink = asset("uploads/layout/" . $headerLogoName);

                    Layout::first()->update([
                        "header_logo" => $headerLogoLink
                    ]);

                    return response()->json([
                        "status" => "success",
                        "message" => "Updated successfully",
                    ]);
                }
            } else {

                return response()->json([
                    "status" => "failed",
                    "message" => "Please select a logo",
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                "status" => "failed",
                "message" => "Something went wrong",
                "error" => $th->getMessage(),
            ]);
        }
    }

    public function footerUpdate(Request $request)
    {
        try {
            if ($request->hasFile("footer_logo")) {
                $footerLogo = $request->file("footer_logo");

                if ($footerLogo->getClientOriginalExtension() != "jpg" && $footerLogo->getClientOriginalExtension() != "png" && $footerLogo->getClientOriginalExtension() != "jpeg") {
                    return response()->json([
                        "status" => "failed",
                        "message" => "Please select a JPG, JPEG or PNG logo",
                    ]);
                } else {
                    // Delete Old Logo
                    $OldFooterLogo = Layout::first()->footer_logo;
                    unlink(public_path($OldFooterLogo));

                    $footerLogoName = uniqid() . "_footer_logo" . "." . $footerLogo->getClientOriginalExtension();
                    $footerLogo->move(public_path('uploads/layout/'), $footerLogoName);
                    $footerLogoLink = asset("uploads/layout/" . $footerLogoName);

                    Layout::first()->update([
                        "footer_logo" => $footerLogoLink,
                        "footer_text" => $request->input("footer_text"),
                    ]);

                    return response()->json([
                        "status" => "success",
                        "message" => "Updated successfully",
                    ]);
                }
            } else {
                Layout::first()->update([
                    "footer_text" => $request->input("footer_text"),
                ]);

                return response()->json([
                    "status" => "success",
                    "message" => "Updated successfully",
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                "status" => "failed",
                "message" => "Something went wrong",
                "error" => $th->getMessage(),
            ]);
        }
    }

    public function faviconUpdate(Request $request)
    {
        try {
            if ($request->hasFile("favicon")) {
                $favicon = $request->file("favicon");

                // Delete Old Logo
                $OldFavicon = Layout::first()->favicon;
                unlink(public_path($OldFavicon));

                $faviconName = uniqid() . "_favicon" . "." . $favicon->getClientOriginalExtension();
                $favicon->move(public_path('uploads/layout/'), $faviconName);
                $faviconLink = asset("uploads/layout/" . $faviconName);

                Layout::first()->update([
                    "favicon" => $faviconLink
                ]);
                return response()->json([
                    "status" => "success",
                    "message" => "Updated successfully",
                ]);
            } else {
                return response()->json([
                    "status" => "failed",
                    "message" => "Please select a icon",
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                "status" => "failed",
                "message" => "Something went wrong",
                "error" => $th->getMessage(),
            ]);
        }
    }

    public function layoutData(Request $request)
    {
        $data = Layout::first();
        return response()->json([
            "status" => "success",
            "data" => $data
        ]);
    }
}
