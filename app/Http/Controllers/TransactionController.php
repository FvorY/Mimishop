<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use DB;
use Auth;
class TransactionController extends Controller
{
    public function index(){
      $data = DB::table('transaction')
                ->join('transaction_detail', 'transaction_detail.id_transaction', '=', 'transaction.id_transaction')
                ->join('account', 'account.id_account', '=', 'transaction.id_account')
                ->join('figure', 'figure.id_figure', '=', 'transaction_detail.id_figure')
                ->paginate(15);

      $countcart = DB::table('cart')
                    ->where('id_account', Auth::user()->id_account)
                    ->count();

      return view('transaction.transaction', compact('data', 'countcart'));
    }
}
