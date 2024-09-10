<?php

namespace App\Http\Controllers\Dashboard\Website\Service;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    public function showFeaturePage()
    {
        return view("pages.dashboard.website.feature-page");
    }

    public function featureData()
    {
        try {
            $data = Feature::all();
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

    public function featureById(Request $request)
    {
        try {
            $id = $request->input("id");
            $data = Feature::where("id", $id)->first();
            return response()->json([
                'status' => 'success',
                'message' => 'Feature found successfully',
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

    public function createFeature(Request $request)
    {
        try {
            $title1 = $request->input("title1");
            $description1 = $request->input("description1");
            $image1 = $request->file("image1");
            $title2 = $request->input("title2");
            $description2 = $request->input("description2");
            $image2 = $request->file("image2");

            $image1Name = uniqid() . "_feature1" . "." . $image1->getClientOriginalExtension();
            $image1->move(public_path('uploads/features/'), $image1Name);
            $image1Url = asset("uploads/features/" . $image1Name);

            $image2Name = uniqid() . "_feature2" . "." . $image2->getClientOriginalExtension();
            $image2->move(public_path('uploads/features/'), $image2Name);
            $image2Url = asset("uploads/features/" . $image2Name);


            Feature::create([
                "title1" => $title1,
                "image1" => $image1Url,
                "description1" => $description1,

                "title2" => $title2,
                "image2" => $image2Url,
                "description2" => $description2,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Feature created successfully.',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => "Something went wrong, Please try again.",
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function updateFeature(Request $request)
    {
        try {
            if ($request->hasFile('image1') && $request->hasFile('image2')) {

                $id = $request->input("id");
                $title1 = $request->input("title1");
                $description1 = $request->input("description1");
                $image1 = $request->file("image1");
                $title2 = $request->input("title2");
                $description2 = $request->input("description2");
                $image2 = $request->file("image2");

                $image1Name = uniqid() . "_feature1" . "." . $image1->getClientOriginalExtension();
                $image1->move(public_path('uploads/features/'), $image1Name);
                $image1Url = asset("uploads/features/" . $image1Name);

                $image2Name = uniqid() . "_feature2" . "." . $image2->getClientOriginalExtension();
                $image2->move(public_path('uploads/features/'), $image2Name);
                $image2Url = asset("uploads/features/" . $image2Name);


                Feature::where("id", $id)->update([
                    "title1" => $title1,
                    "image1" => $image1Url,
                    "description1" => $description1,

                    "title2" => $title2,
                    "image2" => $image2Url,
                    "description2" => $description2,
                ]);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Feature updated successfully.',
                ], 200);
            } else if ($request->hasFile('image1')) {

                $id = $request->input("id");
                $title1 = $request->input("title1");
                $description1 = $request->input("description1");
                $image1 = $request->file("image1");

                $title2 = $request->input("title2");
                $description2 = $request->input("description2");

                $image1Name = uniqid() . "_feature1" . "." . $image1->getClientOriginalExtension();
                $image1->move(public_path('uploads/features/'), $image1Name);
                $image1Url = asset("uploads/features/" . $image1Name);

                Feature::where("id", $id)->update([
                    "title1" => $title1,
                    "image1" => $image1Url,
                    "description1" => $description1,

                    "title2" => $title2,
                    "description2" => $description2,
                ]);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Feature updated successfully.',
                ], 200);
            } else if ($request->hasFile('image2')) {
                $id = $request->input("id");
                $title1 = $request->input("title1");
                $description1 = $request->input("description1");
                $title2 = $request->input("title2");
                $description2 = $request->input("description2");
                $image2 = $request->file("image2");

                $image2Name = uniqid() . "_feature2" . "." . $image2->getClientOriginalExtension();
                $image2->move(public_path('uploads/features/'), $image2Name);
                $image2Url = asset("uploads/features/" . $image2Name);

                Feature::where("id", $id)->update([
                    "title1" => $title1,
                    "description1" => $description1,

                    "title2" => $title2,
                    "image2" => $image2Url,
                    "description2" => $description2,
                ]);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Feature updated successfully.',
                ], 200);
            } else {
                $id = $request->input("id");
                $title1 = $request->input("title1");
                $description1 = $request->input("description1");
                $title2 = $request->input("title2");
                $description2 = $request->input("description2");

                Feature::where("id", $id)->update([
                    "title1" => $title1,
                    "description1" => $description1,

                    "title2" => $title2,
                    "description2" => $description2,
                ]);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Feature updated successfully.',
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

    public function deleteFeature(Request $request)
    {
        try {
            $id = $request->input("id");
            $check = Feature::where("id", $id)->first();
            $image1 = $check->image1;
            $image2 = $check->image2;
            unlink(public_path($image1));
            unlink(public_path($image2));
            $check->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Feature deleted successfully.',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => "Something went wrong, Please try again.",
            ], 500);
        }
    }
}
