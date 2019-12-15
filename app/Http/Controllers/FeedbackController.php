<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;

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

    public function feedback() {
      return view('feedback.feedback');
    }

    public function dofeedback(Request $request) {
      DB::beginTransaction();
      try {

        $id = DB::table("feedback")->max('id_feedback') + 1;

        DB::table("feedback")
            ->insert([
              "id_feedback" => $id,
              "feedback" => $request->feedback,
            ]);

        DB::commit();
        Session::flash('sukses','Feedback berhasil dikirim!');
        return back()->with('sukses', 'gagal');
      } catch (\Exception $e) {
        DB::rollback();
        Session::flash('gagal','Feedback gagal dikirim!');
        return back()->with('sukses', 'gagal');
      }

    }
}
