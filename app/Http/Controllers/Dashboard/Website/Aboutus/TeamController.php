<?php

namespace App\Http\Controllers\Dashboard\Website\Aboutus;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{

    public function showTeamPage()
    {
        return view("pages.dashboard.website.team-page");
    }

    public function teamData()
    {
        try {
            $data = Team::all();
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

    public function teamById(Request $request)
    {
        try {
            $id = $request->input("id");
            $data = Team::where("id", $id)->first();
            return response()->json([
                'status' => 'success',
                'message' => 'Team found successfully',
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

    public function createTeam(Request $request)
    {
        try {
            $name = $request->input("name");
            $designation = $request->input("designation");
            $image = $request->file("image");
            $description = $request->input("description");
            $linkedin = $request->input("linkedin_link");
            $github = $request->input("github_link");
            $facebook = $request->input("facebook_link");
            $whatsapp = $request->input("whatsapp_link");

            $imageName = uniqid() . "_team" . "." . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/team/'), $imageName);
            $imageUrl = asset("uploads/team/" . $imageName);

            Team::create([
                "name" => $name,
                "designation" => $designation,
                "image" => $imageUrl,
                "description" => $description,
                "linkedin_link" => $linkedin,
                "github_link" => $github,
                "facebook_link" => $facebook,
                "whatsapp_link" => $whatsapp
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Team created successfully.',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => "Something went wrong, Please try again.",
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function updateTeam(Request $request)
    {
        try {
            if ($request->hasFile('image')) {

                $id = $request->input("id");

                // Delete Old Image
                $oldImage = Team::where('id', $id)->first()->image;
                unlink(public_path($oldImage));

                $name = $request->input("name");
                $designation = $request->input("designation");
                $image = $request->file("image");
                $description = $request->input("description");
                $linkedin = $request->input("linkedin_link");
                $github = $request->input("github_link");
                $facebook = $request->input("facebook_link");
                $whatsapp = $request->input("whatsapp_link");

                $imageName = uniqid() . "_team" . "." . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/team/'), $imageName);
                $imageUrl = asset("uploads/team/" . $imageName);

                Team::where("id", $id)->update([
                    "name" => $name,
                    "designation" => $designation,
                    "image" => $imageUrl,
                    "description" => $description,
                    "linkedin_link" => $linkedin,
                    "github_link" => $github,
                    "facebook_link" => $facebook,
                    "whatsapp_link" => $whatsapp
                ]);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Team updated successfully.',
                ], 200);
            } else {
                $id = $request->input("id");
                $name = $request->input("name");
                $designation = $request->input("designation");
                $description = $request->input("description");
                $linkedin = $request->input("linkedin_link");
                $github = $request->input("github_link");
                $facebook = $request->input("facebook_link");
                $whatsapp = $request->input("whatsapp_link");

                Team::where("id", $id)->update([
                    "name" => $name,
                    "designation" => $designation,
                    "description" => $description,
                    "linkedin_link" => $linkedin,
                    "github_link" => $github,
                    "facebook_link" => $facebook,
                    "whatsapp_link" => $whatsapp
                ]);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Team updated successfully.',
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

    public function deleteTeam(Request $request)
    {
        try {
            $id = $request->input("id");
            $check = Team::where("id", $id)->first();
            $image = $check->image;
            unlink(public_path($image));
            $check->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Team deleted successfully.',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => "Something went wrong, Please try again.",
            ], 500);
        }
    }
}
