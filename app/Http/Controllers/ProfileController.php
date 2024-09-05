<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\View\View;


class ProfileController extends Controller
{
    public function showProfilePage(): View
    {
        return view("pages.dashboard.profile");
    }
    public function userDetails(Request $request)
    {
        try {
            $email = $request->header('email');
            $id = $request->header('id');
            $user = Admin::where('email', $email)->where('id', $id)->first();
            return response()->json([
                'status' => 'success',
                'data' => $user
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong.',
            ], 500);
        }
    }

    public function updateProfileInfo(Request $request)
    {
        try {
            $email = $request->header('email');
            $id = $request->header('id');

            $name = $request->input('name');
            // $email = $request->input('email');

            $user = Admin::where('email', $email)->where('id', $id)->first();

            $user->update([
                'name' => $name,
                // 'email' => $email,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Profile updated successfully.',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong. Please try again.',
            ], 500);
        }
    }

    public function updateProfilePicture(Request $request)
    {
    //     try {
    //         $email = $request->header('email');
    //         $id = $request->header('id');
    //         $user = User::where('email', $email)->where('id', $id)->first();
    //         $user->update([
    //             'profile_picture' => $request->profile_picture
    //         ]);
    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'Profile picture updated successfully.',
    //         ]);
    //     } catch (\Throwable $th) {
    //         return response()->json([
    //             'status' => 'failed',
    //             'message' => 'Something went wrong. Please try again.',
    //         ], 500);
    //     }
    }

    public function UpdatePassword(Request $request)
    {
        // try {
        //     $email = $request->header('email');
        //     $id = $request->header('id');
        //     $user = User::where('email', $email)->where('id', $id)->first();
        //     $user->update([
        //         'password' => $request->password
        //     ]);
        //     return response()->json([
        //         'status' => 'success',
        //         'message' => 'Password updated successfully.',
        //     ]);
        // } catch (\Throwable $th) {
        //     return response()->json([
        //         'status' => 'failed',
        //         'message' => 'Something went wrong. Please try again.',
        //     ], 500);
        // }
    }
}
