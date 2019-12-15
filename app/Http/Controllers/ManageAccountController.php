<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class ManageAccountController extends Controller
{
    public function index() {

      $data = DB::table("Account")
                ->get();

      return view('account.manageaccount', compact('data'));
    }
}
