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
            if ($request->hasFile('image')) {

                // Delete Old Image
                $oldImage = AboutUs::first()->image;
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


                return response()->json([
                    "status" => "success",
                    "message" => "About Us Updated Successfully.",
                    "data" => $imageUrl,
                ]);
            } else {

                $videoLink = $request->input("video_link");
                $description = $request->input("description");

                AboutUs::first()->update([
                    "description" => $description,
                    "video_link" => $videoLink,
                ]);

                return response()->json([
                    "status" => "success",
                    "message" => "About Us Updated Successfully.",
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => "Something went wrong, Please try again.",
                'error' => $th->getMessage(),
            ], 500);
        }
    }
}
