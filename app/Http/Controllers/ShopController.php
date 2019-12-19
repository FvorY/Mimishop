<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use Auth;

use Carbon\Carbon;

class ShopController extends Controller
{
    public function index() {
      $data = DB::table("figure")
                ->join('category', "category.id_category", '=', 'figure.id_category')
                ->paginate(15);

      $countcart = DB::table('cart')
                    ->where('id_account', Auth::user()->id_account)
                    ->count();

      return view('shop.shop', compact('data', 'countcart'));
    }

    public function search(Request $request) {
      $data = DB::table("figure")
                ->join('category', "category.id_category", '=', 'figure.id_category')
                ->where('figure.name', 'like', '%' . $request->search . '%')
                ->paginate(15);

                // dd($data);

      return view('shop.shop', compact('data'));
    }

    public function add(Request $request) {
      DB::beginTransaction();
      try {

        $check = DB::table('cart')->where('id_figure', $request->id_figure)->where('id_account', $request->id_account)->first();

        if (count($check) != 0) {
          DB::table('cart')
            ->where('id_cart', $check->id_cart)
            ->Update([
              'qty' => $check->qty + 1,
            ]);
        } else {
          $id = DB::table('cart')->max('id_cart') + 1;

          DB::table('cart')
            ->insert([
              'id_cart' => $id,
              'id_figure' => $request->id_figure,
              'id_account' => $request->id_account,
              'qty' => 1,
            ]);
        }

        DB::commit();
        return response()->json([
          'status' => 'berhasil'
        ]);
      } catch (\Exception $e) {
        DB::rollback();
        return response()->json([
          'status' => 'gagal'
        ]);
      }

    }

    public function get(){
      $data = DB::table('cart')
                ->join('figure', 'figure.id_figure', '=', 'cart.id_figure')
                ->join('category', 'category.id_category', '=', 'figure.id_category')
                ->where('id_account', Auth::user()->id_account)
                ->get();

      return response()->json($data);
    }

    public function remove(Request $request) {
      DB::beginTransaction();
      try {

        $data = DB::table('cart')
                  ->where('id_account', Auth::user()->id_account)
                  ->where('id_figure', $request->id_figure)
                  ->delete();

        DB::commit();
        return response()->json([
          'status' => 'berhasil'
        ]);
      } catch (\Exception $e) {
        DB::rollback();
        return response()->json([
          'status' => 'gagal'
        ]);
      }

    }

    public function cartlist(){
      $data = DB::table('cart')
                ->join('figure', 'figure.id_figure', '=', 'cart.id_figure')
                ->join('category', 'category.id_category', '=', 'figure.id_category')
                ->where('id_account', Auth::user()->id_account)
                ->get();

      $countcart = DB::table('cart')
                    ->where('id_account', Auth::user()->id_account)
                    ->count();

      return view('cart.cart', compact('data', 'countcart'));
    }

    public function savecart(Request $request){
      DB::beginTransaction();
      try {

        $cart = DB::table('cart')
                ->where('id_account', Auth::user()->id_account)
                ->get();

        $id = DB::table('transaction')
                ->max('id_transaction') + 1;

        DB::table('transaction')
            ->insert([
              'id_transaction' => $id,
              'id_account' => Auth::user()->id_account,
              'date' => Carbon::now()
            ]);

        foreach ($cart as $key => $value) {
          $figure = $value->id_figure;
          $qty = $value->qty;

          $iddetail = DB::table('transaction_detail')
                        ->max('id_detail') + 1;

          DB::table('transaction_detail')
                  ->insert([
                    'id_detail' => $iddetail,
                    'id_transaction' => $id,
                    'id_figure' => $figure,
                    'qty' => $qty
                  ]);
        }

        DB::table('cart')
            ->truncate();

        DB::commit();
        return response()->json([
          'status' => 'berhasil'
        ]);
      } catch (\Exception $e) {
        DB::rollback();
        return response()->json([
          'status' => 'gagal'
        ]);
      }

    }

    public function updateqty(Request $request) {
      DB::beginTransaction();
      try {


        DB::table('cart')
            ->where('id_account', Auth::user()->id_account)
            ->where('id_figure', $request->id_figure)
            ->update([
              'qty' => $request->qty
            ]);

        DB::commit();
      } catch (\Exception $e) {
        DB::rollback();
      }

    }

    public function detailfigure(Request $request) {
      $data = DB::table('figure')
                ->join('category', 'category.id_category', '=', 'figure.id_category')
                ->where('id_figure', $request->id)
                ->first();

      return response()->json($data);
    }
}
