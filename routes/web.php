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
// Route::get('/home', function () {
//     return 'home';
// });
// Route::get('test', function () {
//     return \App\User::find(12)->getListRemoveFriends();
// });

Route::get('testArray', 'PostMultiController@updateActionStatus');
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
