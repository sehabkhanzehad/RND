<?php

namespace App\Http\Controllers\Dashboard\Website\Service;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function showServicePage()
    {
        return view("pages.dashboard.website.service-page");
    }

    public function serviceData()
    {
        try {
            $data = Service::all();
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

    public function serviceById(Request $request)
    {
        try {
            $id = $request->input("id");
            $data = Service::where("id", $id)->first();
            return response()->json([
                'status' => 'success',
                'message' => 'Service found successfully',
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

    public function createService(Request $request)
    {
        try {
            $name = $request->input("name");
            $short_des = $request->input("short_des");
            $image = $request->file("image");
            // $title = $request->input("title");
            // $slug = $request->input("slug");
            // $description = $request->input("description");

            $imageName = uniqid() . "_service" . "." . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/service/'), $imageName);
            $imageUrl = asset("uploads/service/" . $imageName);

            Service::create([
                "name" => $name,
                "image" => $imageUrl,
                "short_des" => $short_des,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Service created successfully.',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => "Something went wrong, Please try again.",
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function updateService(Request $request)
    {
        try {
            if ($request->hasFile('image')) {

                $id = $request->input("id");

                // Delete Old Image
                $oldImage = Service::where('id', $id)->first()->image;
                unlink(public_path($oldImage));

                $name = $request->input("name");
                $image = $request->file("image");
                $short_des = $request->input("short_des");


                $imageName = uniqid() . "_service" . "." . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/service/'), $imageName);
                $imageUrl = asset("uploads/service/" . $imageName);

                Service::where("id", $id)->update([
                    "name" => $name,
                    "image" => $imageUrl,
                    "short_des" => $short_des,
                ]);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Service updated successfully.',
                ], 200);
            } else {
                $id = $request->input("id");
                $name = $request->input("name");
                $short_des = $request->input("short_des");

                Service::where("id", $id)->update([
                    "name" => $name,
                    "short_des" => $short_des,
                ]);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Service updated successfully.',
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

    public function deleteService(Request $request)
    {
        try {
            $id = $request->input("id");
            $check = Service::where("id", $id)->first();
            $image = $check->image;
            unlink(public_path($image));
            $check->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Service deleted successfully.',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => "Something went wrong, Please try again.",
            ], 500);
        }
    }
}
