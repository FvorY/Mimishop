<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use File;
use Session;
use Illuminate\Support\Facades\Crypt;

class AccountController extends Controller
{
    public function index($id) {
      $iden = decrypt($id);

      $data = DB::table("account")
                ->where('id_account', $iden)
                ->first();

      return view('account.account', compact('data'));
    }

    public function edit($id) {
      $iden = decrypt($id);

      $data = DB::table("account")
                ->where('id_account', $iden)
                ->first();

      return view('account.edit', compact('data'));
    }

    public function doedit(Request $req) {
      DB::beginTransaction();
      try {

        $folder = "profile";
        $dir = 'image/uploads/account/' . decrypt($req->id_account);
        $this->deleteDir($dir);
        $childPath = $dir . '/';
        $path = $childPath;

        $file = $req->file('profile_picture');

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
          $imgPath = $req->profile_picture_old;
        }


        DB::table("Account")
          ->where("id_account", decrypt($req->id_account))
          ->Update([
            "fullname" => $req->fullname,
            "email" => $req->email,
            "phone" => $req->phone,
            "gender" => $req->gender,
            "address" => $req->address,
            "profile_picture" => $imgPath
          ]);

        DB::commit();
        Session::flash('sukses','Update profile berhasil disimpan!');
        return back()->with('sukses', 'gagal');
      } catch (\Exception $e) {
        DB::commit();
        Session::flash('gagal','Update profile gagal disimpan!');
        return back()->with('sukses', 'gagal');
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
