<?php

namespace App\Http\Controllers\Dashboard\Website;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    public function showHeroPage()
    {
        return view('pages.dashboard.website.hero-page');
    }
    public function heroData()
    {
        $data = Hero::first();
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function updateBackground(Request $request)
    {
        try {
            $backgroundImage = $request->file('background_image');
            $hoverImage = $request->file('hover_image');

            if ($request->hasFile('background_image') && $request->hasFile('hover_image')) {
                // Delete old Background Image
                $oldBackgroundImage = Hero::first()->background_image;
                unlink(public_path($oldBackgroundImage));

                // Upload new Background Image
                $backgroundImageName = uniqid() . '_background' . '.' . $backgroundImage->getClientOriginalExtension();
                $backgroundImage->move(public_path('uploads/hero'), $backgroundImageName);
                $backgroundImageUrl = asset('uploads/hero/' . $backgroundImageName);

                // Delete old Hover Image
                $oldHoverImage = Hero::first()->hover_image;
                unlink(public_path($oldHoverImage));

                // Upload new Hover Image
                $hoverImageName = uniqid() . '_hover' . '.' . $hoverImage->getClientOriginalExtension();
                $hoverImage->move(public_path('uploads/hero'), $hoverImageName);
                $hoverImageUrl = asset('uploads/hero/' . $hoverImageName);

                Hero::first()->update([
                    'background_image' => $backgroundImageUrl,
                    'hover_image' => $hoverImageUrl
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Updated successfully',
                ]);
            } else if ($request->hasFile('hover_image')) {
                // Delete old Hover Image
                $oldHoverImage = Hero::first()->hover_image;
                unlink(public_path($oldHoverImage));

                // Upload new Hover Image
                $hoverImageName = uniqid() . '_hover' . '.' . $hoverImage->getClientOriginalExtension();
                $hoverImage->move(public_path('uploads/hero'), $hoverImageName);
                $hoverImageUrl = asset('uploads/hero/' . $hoverImageName);

                Hero::first()->update([
                    'hover_image' => $hoverImageUrl
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Updated successfully',
                ]);
            } else {
                // Delete old Background Image
                $oldBackgroundImage = Hero::first()->background_image;
                unlink(public_path($oldBackgroundImage));

                // Upload new Background Image
                $backgroundImageName = uniqid() . '_background' . '.' . $backgroundImage->getClientOriginalExtension();
                $backgroundImage->move(public_path('uploads/hero'), $backgroundImageName);
                $backgroundImageUrl = asset('uploads/hero/' . $backgroundImageName);

                Hero::first()->update([
                    'background_image' => $backgroundImageUrl
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Updated successfully',
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong',
            ]);
        }
    }

    public function updateContent(Request $request)
    {
        try {
            $title = $request->title;
            $description = $request->description;

            Hero::first()->update([
                'title' => $title,
                'description' => $description
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Updated successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong',
            ]);
        }
    }
}
