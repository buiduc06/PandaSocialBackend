<?php

/*
|--------------------------------------------------------------------------
| Ticket Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('getlistRoom', 'TicketProductController@index');
Route::get('getlistcategory', 'TicketProductController@index');
Route::get('getlistcategory', function () {
    return response()->json(\App\ticket_category::all(), 200);
});
// Route::get('findRoomById', 'TicketProductController@findRoomById');
Route::get('findroombyid/{id}', 'TicketProductController@findRoomById');
Route::post('filterdata', 'TicketProductController@filterdata');
