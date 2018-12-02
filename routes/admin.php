<?php

$controller = 'Admin\\AdminController@';
$routeName = 'admin';
Route::get('/', $controller.'index')->name($routeName);
 

// Route::get('users/getData', $controller.'getData')->name('users.getData');
// Route::get('users', $controller.'getManagerUser');


######################################## course ########################################

Route::group(['prefix' => 'course'], function () {

    $controller = 'Admin\\CourseController@';
    $routeName = 'admin.course';

    Route::get('/', $controller.'index')->name($routeName);
    Route::get('/add-course', $controller.'create')->name($routeName.'.create');
    Route::post('/add-course', $controller.'store')->name($routeName.'.store');
    Route::get('/edit-course/{id?}', $controller.'edit')->name($routeName.'.edit');
    Route::post('/edit-course', $controller.'update')->name($routeName.'.update');
    Route::post('/delete-course', $controller.'destroy')->name($routeName.'.destroy');
});
###################################### End course ########################################


######################################## course ########################################

Route::group(['prefix' => 'category'], function () {

    $controller = 'Admin\\CategoryController@';
    $routeName = 'admin.category';

    Route::get('/', $controller.'index')->name($routeName);
    Route::get('/index', $controller.'index')->name($routeName.'.index');
    Route::get('/add-category', $controller.'create')->name($routeName.'.create');
    Route::post('/add-category', $controller.'store')->name($routeName.'.store');
    Route::get('/edit-category/{id?}', $controller.'edit')->name($routeName.'.edit');
    Route::post('/edit-category', $controller.'update')->name($routeName.'.update');
    Route::post('/delete-category', $controller.'destroy')->name($routeName.'.destroy');
});
###################################### End course ########################################


######################################## manager user ########################################

Route::group(['prefix' => 'user'], function () {

    $controller = 'Admin\\ManagerUserControlelr@';
    $routeName = 'admin.manager_user';

    Route::get('/list-user', $controller.'index')->name($routeName.'.index');
    Route::get('/', $controller.'index')->name($routeName);
    Route::get('/index', $controller.'index')->name($routeName.'.index');
    Route::post('/block-user', $controller.'destroy')->name($routeName.'.destroy');
});
###################################### End course ########################################


######################################## video ########################################

Route::group(['prefix' => 'video'], function () {

    $controller = 'Admin\\VideoController@';
    $routeName = 'admin.video';

    Route::get('/{video_name}', $controller.'downloadVideo')->name($routeName.'.download.video');
    Route::post('delete', $controller.'delete')->name($routeName.'.delete.video');
});