<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Illuminate\Support\Facades\Crypt;

class AccountController extends Controller
{
    public function index($id) {
      $iden = decrypt($id);

      $data = DB::table("account")
                ->where('id_account', $iden)
                ->first();

                // dd($data);

      return view('account.account', compact('data'));
    }
}
