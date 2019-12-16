<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Validator;
use Session;
use File;

class ManageAccountController extends Controller
{
    public function index() {

      $data = DB::table("Account")
                ->get();

      return view('account.manageaccount', compact('data'));
    }

    public function dosaveuser(Request $request) {
      // dd($request);
        // DB::beginTransaction();
        // try {

          $rules = array(
              'fullname' => 'required',  // password can only be alphanumeric and has to be greater than 3 characters
              "email" => 'required|email',
              "password" => 'required',
              "confirm_password" => 'required',
              "role" => 'required',
              "phone" => 'required',
              "gender" => 'required',
              "address" => 'required',
          );

          $validator = Validator::make($request->all(), $rules);

          if ($validator->fails()) {
            Session::flash('validate', "Isi semua form");
            return back()->with('validate',"Isi semua form");
            // dd($validator);
              // return Redirect('/login')
              // ->withErrors($validator) // send back all errors to the login form
              // ->withInput($req->except('password')); // send back the input (not the password) so that we can repopulate the form
          } else {
            if ($request->password != $request->confirm_password) {
              Session::flash('tidaksama','Account password & confirm password tidak sama!');
              return back()->with('tidaksama', 'tidaksama');
            } else {
              $id = DB::table("account")->max('id_account') + 1;

              $folder = "profile";
              $dir = 'image/uploads/account/' . $id;
              $this->deleteDir($dir);
              $childPath = $dir . '/';
              $path = $childPath;

              $file = $request->file('profile_picture');

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

              DB::table("account")
                  ->insert([
                    "id_account" => $id,
                    "fullname" => $request->fullname,
                    "email" => $request->email,
                    "password" => $request->password,
                    "confirm_password" => $request->confirm_password,
                    "role" => $request->role,
                    "phone" => $request->phone,
                    "gender" => $request->gender,
                    "address" => $request->address,
                    "profile_picture" => $imgPath,
                    "terms_and_condition" => $request->terms_and_condition,  
                  ]);

                  DB::commit();
                  Session::flash('sukses','Account berhasil disimpan!');
                  return back()->with('sukses', 'sukses');
            }
          }

        //     } catch (\Exception $e) {
        //       DB::rollback();
        //       Session::flash('gagal','Account gagal disimpan!');
        //       return back()->with('gagal', 'gagal');
        // }
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
