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

Route::get('/', function () {
    return view('shop.shop');
});

Route::get('cartlist', function() {
    return view('cart.cart');
});

Route::get('dosaveuser', 'ManageAccountController@dosaveuser');
Route::post('dosaveuser', 'ManageAccountController@dosaveuser');

Route::group(['middleware' => 'guest'], function () {

  Route::get('login', function() {
      return view('login.login');
  });

  Route::get('register', function() {
      return view('login.login');
  });

  Route::get('dologin', 'LoginController@dologin');

  Route::get('register', function() {
      return view('login.login');
  });

});

Route::group(['middleware' => 'auth'], function () {
    Route::get('logout', 'LogoutController@dologout');

    Route::get('myaccount/{id}', 'AccountController@index');

    Route::get('editaccount/{id}', 'AccountController@edit');

    Route::get('doedit', 'AccountController@doedit');
    Route::post('doedit', 'AccountController@doedit');
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

});


Route::group(['middleware' => 'member'], function () {
    Route::get('feedback', 'FeedbackController@feedback');

    Route::get('dofeedback', 'FeedbackController@dofeedback');
    Route::post('dofeedback', 'FeedbackController@dofeedback');
});
