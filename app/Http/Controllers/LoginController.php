<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Account;
use Validator;
// use Carbon\Carbon;
use Session;
use DB;

class LoginController extends Controller
{

    public function __construct(){
        $this->middleware('guest');
    }

    public function dologin(Request $req) {

      $datauser = Account::where("email", $req->email)->first();
      // dd($datauser);
      if ($datauser != null) {
        if ($datauser->role == "admin") {
          $rules = array(
              'email' => 'required|min:3', // make sure the email is an actual email
              // 'email' => 'required|min:3|email',
              'password' => 'required|min:2' // password can only be alphanumeric and has to be greater than 3 characters
          );
        } else {
          $rules = array(
              'email' => 'required|min:3|email', // make sure the email is an actual email
              // 'email' => 'required|min:3|email',
              'password' => 'required|min:2' // password can only be alphanumeric and has to be greater than 3 characters
          );
        }
      } else {
        $rules = array(
            'email' => 'required|min:3|email', // make sure the email is an actual email
            // 'email' => 'required|min:3|email',
            'password' => 'required|min:2' // password can only be alphanumeric and has to be greater than 3 characters
        );
      }

    // dd($req->all());
      $validator = Validator::make($req->all(), $rules);
      if ($validator->fails()) {
        Session::flash('validate', "Masukkan email & password dengan benar");
        return back()->with('validate',"Masukkan email & password dengan benar");
        // dd($validator);
          // return Redirect('/login')
          // ->withErrors($validator) // send back all errors to the login form
          // ->withInput($req->except('password')); // send back the input (not the password) so that we can repopulate the form
      } else {
          $email  = $req->email;
          $password  = $req->password;
          $pass_benar = $password;
          // sha1(md5('passwordAllah')
          // $username = str_replace('\'', '', $username);

          $user = Account::where("email", $email)->first();

          $user_valid = [];
          // dd($req->all());

          if ($user != null) {
            $user_pass = Account::where('email',$email)
                            ->where('password',$pass_benar)
                            ->first();

            if ($user_pass != null) {

              Auth::login($user);
              return Redirect('/');
            }else{
              Session::flash('password','Password Yang Anda Masukan Salah!');
              return back()->with('password','email');
            }
          }else{
            Session::flash('email','Email Tidak Ada');
            return back()->with('password','email');
          }


      }
    }
}
