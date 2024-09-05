<?php

namespace App\Http\Controllers\Dashboard\Website\Aboutus;

use App\Http\Controllers\Controller;
use App\Models\AboutItem;
use Illuminate\Http\Request;

class AboutItemController extends Controller
{

    public function getItem()
    {
        try {
            $data = AboutItem::all();
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

    public function createItem(Request $request)
    {
        try {
            $iconName = $request->input("icon_name");
            $title = $request->input("title");
            $description = $request->input("description");

            AboutItem::create([
                "icon_name" => $iconName,
                "title" => $title,
                "description" => $description,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Item Created Successfully.',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong.',
            ]);
        }
    }

    public function updateItem(Request $request)
    {
        try {
            $id = $request->input("id");
            $iconName = $request->input("icon_name");
            $title = $request->input("title");
            $description = $request->input("description");

            AboutItem::where("id", $id)->update([
                "icon_name" => $iconName,
                "title" => $title,
                "description" => $description,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Item Updated Successfully.',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong.',
            ]);
        }
    }

    public function deleteItem(Request $request)
    {
        try {
            $id = $request->input("id");
            AboutItem::where("id", $id)->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Item Deleted Successfully.',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong.',
            ]);
        }
    }
}
