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
    return redirect()->route('login');
});

Auth::routes();



Route::get('cp-login', function () {
    return view('admin.auth.login');
})->name('admin.login');

Route::post('/admin-login', 'Auth\\AdminLoginController@store')->name('admin.store');


Route::get('login', 'Auth\\LoginController@index')->name('login');
Route::post('login', 'Auth\\LoginController@store')->name('login');

Route::get('register', 'Auth\\RegisterController@create')->name('register');
Route::post('register', 'Auth\\RegisterController@store')->name('register');

Route::get('forgot-pwd', function () {
    return view('admin.auth.forgotpassword');
})->name('forgotpwd');

Route::get('logout', function () {
    if (Auth::guard('admin')->check()) {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('msg', 'Logout success');
    } else {
        Auth::logout();
        return redirect()->route('home')->with('msg', 'Logout success');
    }
})->name('logout');
