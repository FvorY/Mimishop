<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use File;
use Session;

class FigureController extends Controller
{
    public function index() {
       $data = DB::table('figure')
                  ->join('category', 'figure.id_category', '=', 'category.id_category')
                  ->get();

        $category = DB::table('category')
                      ->get();

        return view('figure.managefigure', compact('data', 'category'));
    }

    public function dosavefigure(Request $request) {
      DB::beginTransaction();
      try {

        $id = DB::table("figure")->max('id_figure') + 1;

        $folder = "figure";
        $dir = 'image/uploads/figure/' . $id;
        $this->deleteDir($dir);
        $childPath = $dir . '/';
        $path = $childPath;

        $file = $request->file('image');

        $name = null;
        if ($file != null) {
            $name = $folder . '.' . $file->getClientOriginalExtension();
            if (!File::exists($path)) {
                if (File::makeDirectory($path, 0777, true)) {
                    $file->move($path, $name);
                    $imgPath = $childPath . $name;
                } else
                    $imgPath = null;
            } else {
                return 'already exist';
            }
        } else {
          $imgPath = null;
        }

        DB::table("figure")
            ->insert([
              'id_figure' => $id,
              'name' => $request->name,
              'id_category' => $request->id_category,
              'price' => $request->price,
              'description' => $request->description,
              'stock' => $request->stock,
              'image' => $imgPath
            ]);

        DB::commit();
        Session::flash('sukses','Figure berhasil disimpan!');
        return back()->with('sukses', 'sukses');
      } catch (\Exception $e) {
        DB::rollback();
        Session::flash('gagal','Figure gagal disimpan!');
        return back()->with('gagal', 'gagal');
      }

    }

    public function dodeletefigure(Request $request) {
      DB::beginTransaction();
      try {

        DB::table('figure')
          ->where("id_figure", $request->id)
          ->delete();

        DB::commit();
        return response()->json([
          'status' => 'sukses'
        ]);
      } catch (\Exception $e) {
        DB::rollback();
        return response()->json([
          'status' => 'gagal'
        ]);
      }

    }

    public function doeditfigure(Request $request) {
      $data = DB::table('figure')
                 ->join('category', 'figure.id_category', '=', 'category.id_category')
                 ->where('id_figure', $request->id)
                 ->first();

      return response()->json($data);
    }

    public function doupdatefigure(Request $request) {
      // dd($request);
        DB::beginTransaction();
        try {

              // $id = DB::table("figure")->max('id_account') + 1;

              $folder = "figure";
              $dir = 'image/uploads/figure/' . $request->id;
              $childPath = $dir . '/';
              $path = $childPath;

              $file = $request->file('image');

              // dd($file);

              $name = null;
              if ($file != null) {
                  $this->deleteDir($dir);
                  $name = $folder . '.' . $file->getClientOriginalExtension();
                  if (!File::exists($path)) {
                      if (File::makeDirectory($path, 0777, true)) {
                          $file->move($path, $name);
                          $imgPath = $childPath . $name;
                      } else
                          $imgPath = null;
                  } else {
                      return 'already exist';
                  }
              } else {
                $imgPath = $request->image_old;
              }

              DB::table("figure")
                  ->where('id_figure', $request->id)
                  ->update([
                    'name' => $request->name,
                    'id_category' => $request->id_category,
                    'price' => $request->price,
                    'description' => $request->description,
                    'stock' => $request->stock,
                    'image' => $imgPath
                  ]);

              DB::commit();
              Session::flash('sukses','Account berhasil disimpan!');
              return back()->with('sukses', 'sukses');

            } catch (\Exception $e) {
              DB::rollback();
              Session::flash('gagal','Account gagal disimpan!');
              return back()->with('gagal', 'gagal');
        }
    }

    public function deleteDir($dirPath)
    {
        if (!is_dir($dirPath)) {
            return false;
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }
}
