<?php

$controller = 'Customer\\CustomerController@';
$routeName = 'customer';

Route::get('/', $controller.'index')->name($routeName);
Route::get('/index', $controller.'index')->name($routeName.'.index');
Route::get('/home', $controller.'index')->name($routeName.'.home');


Route::get('/khoa-hoc/{slug?}_c_{id}/{video_id?}', $controller.'course')->name($routeName.'.course');
Route::get('/danh-muc/{slug?}_c_{id}', $controller.'getCourseByCategory')->name($routeName.'.category');
Route::post('/binh-luan', $controller.'postComment')->name($routeName.'.postComment');

Route::get('/search/name', $controller.'searchByName')->name($routeName.'.searchByName');
