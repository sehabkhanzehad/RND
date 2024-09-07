<?php

namespace App\Http\Controllers\Dashboard\Website\Aboutus;

use App\Http\Controllers\Controller;
use App\Models\Stat;
use Illuminate\Http\Request;

class StatController extends Controller
{

    public function showStatPage(){
        return view("pages.dashboard.website.stats-page");
    }

    public function statData(){
        try{
            $stats = Stat::all();
            return response()->json([
                "status" => "success",
                "data" => $stats,
            ], 200);
        }
        catch(\Throwable $th){
            return response()->json([
                "status" => "failed ",
                "message" => "Something went wrong, Please try again.",
            ], 500);
        }
    }

    public function statById(Request $request){
        try{
            $statId = $request->input("stat_id");
            $stat = Stat::find($statId);
            return response()->json([
                "status" => "success",
                "message" => "Stat found successfully",
                "data" => $stat,
            ], 200);
        }
        catch(\Throwable $th){
            return response()->json([
                "status" => "failed ",
                "message" => "Something went wrong, Please try again.",
            ], 500);
        }
    }

    public function createStat(Request $request){
        try{
            $statName = $request->input("stat_name");
            $statValue = $request->input("stat_value");

            Stat::create([
                "stat_name" => $statName,
                "stat_value" => $statValue,
            ]);
            return response()->json([
                "status" => "success",
                "message" => "Stat created successfully",
            ], 200);
        }
        catch(\Throwable $th){
            return response()->json([
                "status" => "failed ",
                "message" => "Something went wrong, Please try again.",
                "error" => $th->getMessage(),
            ], 500);
        }
    }

    public function updateStat(Request $request){
        try{
            $statId = $request->input("stat_id");
            $statName = $request->input("stat_name");
            $statValue = $request->input("stat_value");

            $stat = Stat::find($statId);
            $stat->update([
                "stat_name" => $statName,
                "stat_value" => $statValue,
            ]);
            return response()->json([
                "status" => "success",
                "message" => "Stat updated successfully",
            ], 200);
        }
        catch(\Throwable $th){
            return response()->json([
                "status" => "failed ",
                "message" => "Something went wrong, Please try again.",
                "error" => $th->getMessage(),
            ], 500);
        }
    }

    public function deleteStat(Request $request){
        try{
            $statId = $request->input("id");
            $stat = Stat::find($statId);
            $stat->delete();
            return response()->json([
                "status" => "success",
                "message" => "Stat deleted successfully",
            ], 200);
        }
        catch(\Throwable $th){
            return response()->json([
                "status" => "failed ",
                "message" => "Something went wrong, Please try again.",
            ], 500);
        }
    }
}
