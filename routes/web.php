<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('games.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource("budgets","BudgetController");

Route::resource("categories","CategoryController");

Route::resource("platforms","PlatformController");

Route::resource("reviews","ReviewController");

Route::resource("friends","FriendController");

Route::resource("lendings","LendingController");

Route::resource("invoices","InvoiceController");

Route::resource("games","GameController");