<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class FeedbackController extends Controller
{
    public function managefeedback() {
      $data = DB::table("feedback")
                ->get();

      return view('feedback.managefeedback', compact('data'));
    }

    public function approve(Request $request) {
      DB::beginTransaction();
      try {

        DB::table("feedback")
            ->where("id_feedback", $request->id)
            ->update([
              "status" => "Y"
            ]);

        DB::commit();
        return response()->json([
          "status" => "sukses"
        ]);
      } catch (\Exception $e) {
        DB::rollback();
        return response()->json([
          "status" => "gagal",
        ]);
      }
    }

    public function reject(Request $request) {
      DB::beginTransaction();
      try {

        DB::table("feedback")
            ->where("id_feedback", $request->id)
            ->update([
              "status" => "N"
            ]);

        DB::commit();
        return response()->json([
          "status" => "sukses"
        ]);
      } catch (\Exception $e) {
        DB::rollback();
        return response()->json([
          "status" => "gagal",
        ]);
      }
    }
}
