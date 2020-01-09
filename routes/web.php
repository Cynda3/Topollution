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
    return view('welcome');
})->name('welcome');

Route::resource('contacts', 'ContactController')->only('store');

//Traducción
Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});

//User
Route::resource('users', 'UserController')->middleware('verified');

 
//Email
Auth::routes(['verify' =>true]);
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');


// Admin

Route::get('/admin', 'AdminController@index')->middleware('auth', 'role:admin')->name('admin');
Route::get('/admin/users', 'AdminController@listUsers')->middleware('auth', 'role:admin')->name('listUsers');
Route::get('/admin/{id}', 'AdminController@show')->middleware('auth', 'role:admin')->name('adminShow');
