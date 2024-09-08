<?php

namespace App\Http\Controllers\Dashboard\Website;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{

    public function showTestimonialPage()
    {
        return view('pages.dashboard.website.testimonial-page');
    }
    public function testimonialData()
    {
        try {
            $data = Testimonial::all();
            return response()->json([
                'status' => 'success',
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong, Please try again.',
                // 'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function testimonialById(Request $request)
    {
        try {
            $id = $request->input("id");
            $data = Testimonial::where("id", $id)->first();
            return response()->json([
                'status' => 'success',
                'message' => 'Testimonial found successfully',
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed ',
                'message' => 'Something went wrong, Please try again.',
                // 'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function createTestimonial(Request $request)
    {
        try {
            $name = $request->input("name");
            $designation = $request->input("designation");
            $image = $request->file("image");
            $description = $request->input("description");

            $imageName = uniqid() . "_testimonial" . "." . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/testimonial/'), $imageName);
            $imageUrl = asset("uploads/testimonial/" . $imageName);

            Testimonial::create([
                "name" => $name,
                "designation" => $designation,
                "image" => $imageUrl,
                "description" => $description,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Testimonial created successfully.',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => "Something went wrong, Please try again.",
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function updateTestimonial(Request $request)
    {
        try {
            if ($request->hasFile('image')) {

                $id = $request->input("id");

                // Delete Old Image
                $oldImage = Testimonial::where('id', $id)->first()->image;
                unlink(public_path($oldImage));

                $name = $request->input("name");
                $designation = $request->input("designation");
                $image = $request->file("image");
                $description = $request->input("description");

                $imageName = uniqid() . "_testimonial" . "." . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/testimonial/'), $imageName);
                $imageUrl = asset("uploads/testimonial/" . $imageName);

                Testimonial::where("id", $id)->update([
                    "name" => $name,
                    "designation" => $designation,
                    "image" => $imageUrl,
                    "description" => $description,
                ]);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Testimonial updated successfully.',
                ], 200);
            } else {
                $id = $request->input("id");
                $name = $request->input("name");
                $designation = $request->input("designation");
                $description = $request->input("description");

                Testimonial::where("id", $id)->update([
                    "name" => $name,
                    "designation" => $designation,
                    "description" => $description,
                ]);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Testimonial updated successfully.',
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => "Something went wrong, Please try again.",
                'error' => $th->getMessage(),
            ], 500);
        }
    }
    public function deleteTestimonial(Request $request)
    {
        try {
            $id = $request->input("id");
            $check = Testimonial::where("id", $id)->first();
            $image = $check->image;
            unlink(public_path($image));
            $check->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Testimonial deleted successfully.',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => "Something went wrong, Please try again.",
            ], 500);
        }
    }
}
