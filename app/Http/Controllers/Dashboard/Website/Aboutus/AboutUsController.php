<?php

namespace App\Http\Controllers\Dashboard\Website\Aboutus;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{

    public function showAboutUsPage()
    {
        return view("pages.dashboard.website.about-us");
    }

    public function aboutUsData()
    {
        try {
            $data = AboutUs::first();
            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong.',
            ]);
        }
    }

    public function updateAboutUs(Request $request)
    {
        try {
            $check = AboutUs::first();
            if ($check) {

                // Delete Old Image
                $oldImage = $check->image;
                unlink(public_path($oldImage));

                // Upload New Image
                $image = $request->file("image");
                $videoLink = $request->input("video_link");
                $description = $request->input("description");

                $imageName = uniqid() . "_about_us" . "." . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/about-us/'), $imageName);
                $imageUrl = asset("uploads/about-us/" . $imageName);



                AboutUs::first()->update([
                    "description" => $description,
                    "video_link" => $videoLink,
                    "image" => $imageUrl,
                ]);
            } else {
                // Upload New Image
                $image = $request->file("image");
                $videoLink = $request->input("video_link");
                $description = $request->input("description");

                $imageName = uniqid() . "_about_us" . "." . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/about-us/'), $imageName);
                $imageUrl = asset("uploads/about-us/" . $imageName);

                AboutUs::create([
                    "description" => $description,
                    "video_link" => $videoLink,
                    "image" => $imageUrl,
                ]);
            }

            return response()->json([
                "status" => "success",
                "message" => "About Us Updated Successfully.",
                "data" => $imageUrl,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => "failed",
                "message" => "Something went wrong.",
                "error" => $th->getMessage(),
            ]);
        }
    }
}
