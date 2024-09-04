<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{


    public function showCategoryPage()
    {
        return view('pages.dashboard.category-page');
    }


    public function store(Request $request)
    {
        try {
            $userId = $request->header('id');
            $categoryName = $request->input("name");

            Category::create([
                "user_id" => $userId,
                "name" => $categoryName,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Category created successfully.',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => "Something went wrong, Please try again.",
            ], 500);
        }
    }

    public function categoryList(Request $request)
    {
        $userId = $request->header('id');
        return Category::where('user_id', $userId)->get();
    }

    public function categoryById(Request $request){
        sleep(1);
        $userId = $request->header('id');
        $categoryId = $request->input("categoryId");
        return Category::where('id', $categoryId)->where('user_id', $userId)->first();
    }

    public function updateCategory(Request $request){
        try {
            $categoryId = $request->input("categoryId");
            
            $check = Category::where('id', $categoryId)->first();
            if($check){
                $userId= $request->header('id');
                $category = Category::where('id', $categoryId)->where('user_id', $userId)->first();
                $category->update([
                    "name" => $request->input("categoryName"),
                ]);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Category updated successfully.',
                ], 200);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Category not found.',
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong, Please try again.',
                // 'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function deleteCategory(Request $request)
    {
        try {
            $categoryId = $request->input("categoryId");
            $check = Category::where('id', $categoryId)->first();
            if($check){
                $userId= $request->header('id');
                $category = Category::where('id', $categoryId)->where('user_id', $userId)->first();
                $category->delete();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Category deleted successfully.',
                ], 200);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Category not found.',
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong, Please try again.',
                // 'message' => $th->getMessage(),
            ], 500);
        }
    }
}
