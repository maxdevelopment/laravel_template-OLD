<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::group(array('before' => 'admin.auth'), function() {
     Route::any('admin', array('as' => 'admin.main', function () {
        return View::make('admin.admin');
    }));
    Route::get('addproduct', function() {
        return View::make('admin.addproduct');
    });
    Route::get('deleteproduct', array('as' => 'admin.deleteproduct', 'uses' => 'ProductController@adminView'));
    Route::post('addproduct', array('as' => 'admin.addproduct', 'uses' => 'ProductController@add'));
    Route::post('delete', array('uses' => 'ProductController@delete'));
    Route::post('active', array('uses' => 'ProductController@active'));
    Route::post('edit', array('uses' => 'ProductController@edit'));
});
Route::group(array('before' => 'user.auth'), function() {
    Route::any('user', array('as' => 'user.main', function () {
        return View::make('user.user');
    }));
    Route::post('viewaddress', array('uses' => 'AddressController@view'));
    Route::post('viewaddressform', array('uses' => 'AddressController@viewForm'));
    Route::post('addaddress', array('uses' => 'AddressController@add'));
    Route::post('updeladdress', array('uses' => 'AddressController@upDelAddress'));
});
Route::group(array('before' => 'make.reg'), function() {
    Route::get('auth', array('as' => 'auth', 'uses' => 'LoginController@reg'));
    Route::post('auth', array('uses' => 'LoginController@create'));
});

Route::post('processing', array('uses' => 'CartController@processing'));
Route::post('viewcart', array('uses' => 'CartController@view'));
Route::post('editcart', array('uses' => 'CartController@edit'));
Route::post('addtocart', array('as' => 'addtocart', 'uses' => 'CartController@add'));
Route::get('products', array('as' => 'products', 'uses' => 'ProductController@view'));
Route::post('login', array('as' => 'login', 'uses' => 'LoginController@login'));
Route::get('logout', array('as' => 'logout', 'uses' => 'LoginController@logout'));
Route::any('/', array('as' => 'main', 'uses' => 'MainController@index'));

Route::filter('admin.auth', function() 
{
    if (!Auth::check()):
        return Redirect::route('main')->with('message', 'Hands OFF!!!');
    elseif (Crypt::decrypt(Session::get('role')) !== 'admin'):
        return Redirect::route('main')->with('message', 'Hands OFF!!!');
    endif;
});

Route::filter('user.auth', function() 
{
    if (!Auth::check()):
        return Redirect::route('main')->with('message', 'Hands OFF!!!');
    elseif (Crypt::decrypt(Session::get('role')) !== 'user'):
        return Redirect::route('main')->with('message', 'Hands OFF!!!');
    endif;
});

Route::filter('make.reg', function() 
{
    if (Auth::check()):
        return Redirect::route('main')->with('message', 'Exit please!');
    endif;
});