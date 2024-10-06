<?php

namespace App\Http\Controllers\Dashboard\Website;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function showProjectPage()
    {
        return view("pages.dashboard.website.project-page");
    }

    public function projectData()
    {
        try {
            $data = Project::all();
            return response()->json([
                'status' => 'success',
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong, Please try again.',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function projectById(Request $request)
    {
        try {
            $id = $request->input("id");
            $data = Project::where("id", $id)->first();
            return response()->json([
                'status' => 'success',
                'message' => 'Project found successfully',
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed ',
                'message' => 'Something went wrong, Please try again.',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function createProject(Request $request)
    {
        try {
            $name = $request->input("name");
            $description = $request->input("description");
            $image = $request->file("image");
            $category = $request->input("category");
            $url = $request->input("url");
            $published_date = $request->input("published_date");


            $imageName = uniqid() . "_project" . "." . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/project/'), $imageName);
            $imageUrl = asset("uploads/project/" . $imageName);

            Project::create([
                "name" => $name,
                "description" => $description,
                "image" => $imageUrl,
                "category" => $category,
                "url" => $url,
                "published_date" => $published_date
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Project created successfully.',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => "Something went wrong, Please try again.",
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function updateProject(Request $request)
    {
        try {
            if ($request->hasFile('image')) {

                $id = $request->input("id");

                // Delete Old Image
                $oldImage = Project::where('id', $id)->first()->image;
                unlink(public_path($oldImage));

                $name = $request->input("name");
                $image = $request->file("image");
                $description = $request->input("description");
                $category = $request->input("category");
                $url = $request->input("url");
                $published_date = $request->input("published_date");

                $imageName = uniqid() . "_project" . "." . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/project/'), $imageName);
                $imageUrl = asset("uploads/project/" . $imageName);

                Project::where("id", $id)->update([
                    "name" => $name,
                    "description" => $description,
                    "image" => $imageUrl,
                    "category" => $category,
                    "url" => $url,
                    "published_date" => $published_date,
                ]);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Project updated successfully.',
                ], 200);
            } else {
                $id = $request->input("id");
                $name = $request->input("name");
                $description = $request->input("description");
                $category = $request->input("category");
                $url = $request->input("url");
                $published_date = $request->input("published_date");

                Project::where("id", $id)->update([
                    "name" => $name,
                    "description" => $description,
                    "category" => $category,
                    "url" => $url,
                    "published_date" => $published_date,
                ]);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Project updated successfully.',
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

    public function deleteProject(Request $request)
    {
        try {
            $id = $request->input("id");
            $check = Project::where("id", $id)->first();
            $image = $check->image;
            unlink(public_path($image));
            $check->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Project deleted successfully.',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => "Something went wrong, Please try again.",
            ], 500);
        }
    }
}
