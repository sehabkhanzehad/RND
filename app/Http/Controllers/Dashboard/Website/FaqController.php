<?php

namespace App\Http\Controllers\Dashboard\Website;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function showFaqPage()
    {
        return view("pages.dashboard.website.faq-page");
    }

    public function faqData()
    {
        try {
            $data = Faq::all();
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

    public function faqById(Request $request)
    {
        try {
            $id = $request->input("id");
            $data = Faq::where("id", $id)->first();
            return response()->json([
                'status' => 'success',
                'message' => 'Faq found successfully',
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong.',
            ]);
        }
    }

    public function createFaq(Request $request)
    {
        try {
            $question = $request->input("question");
            $answer = $request->input("answer");

            Faq::create([
                "question" => $question,
                "answer" => $answer,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Faq Created Successfully.',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong.',
            ]);
        }
    }

    public function updateFaq(Request $request)
    {
        try {
            $id = $request->input("id");
            $question = $request->input("question");
            $answer = $request->input("answer");

            Faq::where("id", $id)->update([
                "question" => $question,
                "answer" => $answer,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Faq Updated Successfully.',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong.',
            ]);
        }
    }

    public function deleteFaq(Request $request)
    {
        try {
            $id = $request->input("id");
            Faq::where("id", $id)->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Faq Deleted Successfully.',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong.',
            ]);
        }
    }
}
