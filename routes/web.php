<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'ShopController@index');

Route::get('searchfigure', 'ShopController@search');
Route::post('searchfigure', 'ShopController@search');

Route::get('dosaveuser', 'ManageAccountController@dosaveuser');

Route::get('detailfigure', 'ShopController@detailfigure');
// Route::post('dosaveuser', 'ManageAccountController@dosaveuser');

Route::group(['middleware' => 'guest'], function () {

  Route::get('login', function() {
      $countcart = null;
      return view('login.login', compact('countcart'));
  });

  Route::get('register', function() {
      $countcart = null;
      return view('login.login', compact('countcart'));
  });

  Route::get('dologin', 'LoginController@dologin');

  Route::get('register', function() {
    $countcart = null;
    return view('login.login', compact('countcart'));
  });

});

Route::group(['middleware' => 'auth'], function () {
    Route::get('logout', 'LogoutController@dologout');

    Route::get('myaccount/{id}', 'AccountController@index');

    Route::get('editaccount/{id}', 'AccountController@edit');

    Route::get('doedit', 'AccountController@doedit');
    Route::post('doedit', 'AccountController@doedit');

    Route::get('addcart', 'ShopController@add');
    Route::get('getcart', 'ShopController@get');
    Route::get('removecart', 'ShopController@remove');

    Route::get('cartlist', 'ShopController@cartlist');

    Route::get('savecart', 'ShopController@savecart');
    Route::get('updateqty', 'ShopController@updateqty');


});

Route::group(['middleware' => 'admin'], function () {
    Route::get('managefeedback', 'FeedbackController@managefeedback');

    Route::get('feedbackapprove', 'FeedbackController@approve');
    Route::post('feedbackapprove', 'FeedbackController@approve');
    Route::get('feedbackreject', 'FeedbackController@reject');
    Route::post('feedbackreject', 'FeedbackController@reject');

    Route::get('managecategory', 'CategoryController@index');
    Route::get('dosavecategory', 'CategoryController@dosavecategory');
    Route::get('doeditcategory', 'CategoryController@doeditcategory');
    Route::get('doupdatecategory', 'CategoryController@doupdatecategory');
    Route::get('dodeletecategory', 'CategoryController@dodeletecategory');

    Route::get('manageuser', 'ManageAccountController@index');

    Route::get('doedituser', 'ManageAccountController@doedituser');
    Route::get('doupdateuser', 'ManageAccountController@doupdateuser');
    Route::post('doupdateuser', 'ManageAccountController@doupdateuser');
    Route::get('dodeleteuser', 'ManageAccountController@dodeleteuser');

    Route::get('managefigure', 'FigureController@index');

    Route::get('doeditfigure', 'FigureController@doeditfigure');
    Route::get('doupdatefigure', 'FigureController@doupdatefigure');
    Route::post('doupdatefigure', 'FigureController@doupdatefigure');
    Route::get('dodeletefigure', 'FigureController@dodeletefigure');
    Route::get('dosavefigure', 'FigureController@dosavefigure');
    Route::post('dosavefigure', 'FigureController@dosavefigure');

    Route::get('managetransaction', 'TransactionController@index');

});


Route::group(['middleware' => 'member'], function () {
    Route::get('feedback', 'FeedbackController@feedback');

    Route::get('dofeedback', 'FeedbackController@dofeedback');
    Route::post('dofeedback', 'FeedbackController@dofeedback');
});
