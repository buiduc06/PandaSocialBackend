<?php

$controller = 'Customer\\CustomerController@';
$routeName = 'customer';

Route::get('/', $controller.'index')->name($routeName);
Route::get('/index', $controller.'index')->name($routeName.'.index');
Route::get('/home', $controller.'index')->name('home');
