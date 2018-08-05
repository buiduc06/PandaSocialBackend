<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', 'AuthController@login');
Route::post('/refresh', 'AuthController@refresh');
Route::get('/logout', 'AuthController@logout');
Route::post('/register', 'AuthController@register');

Route::group(['middleware' => 'jwt.auth'], function() {

	 

	Route::prefix('Feed')->group(function () {
		Route::any('getNewsFeed', 'PostMultiController@getNewsFeed');
		Route::post('postNewsFeed', 'PostMultiController@postNewsFeed');
		Route::post('updateActionStatus', 'PostMultiController@updateActionStatus');
		Route::post('deletePost', 'PostMultiController@deletepost');

	});
	Route::prefix('user')->group(function () {
		Route::any('getListSuggestFriends', 'FriendShipController@getListFriendNotFriendShip');
		Route::post('makefriend', 'FriendShipController@makefriend');
		Route::post('confirmFriend', 'FriendShipController@confirmFriend');
		Route::post('deleteRequestFriend', 'FriendShipController@deleteRequestFriend');
		Route::get('me', 'AuthController@me');
		Route::get('getMyPost', 'PostMultiController@getMyPost');
		Route::post('getPostByUid', 'PostMultiController@getPostByUid');
		Route::post('getUserByUid', 'AuthController@getUserByUid');
		Route::post('uploadImage', 'GallaryController@uploadImage');
		Route::post('addCommentToPost', 'CommentController@addCommentToPost');
	});

	Route::post('getMyInfo', 'AuthController@me');
	Route::get('getMyInfo', 'AuthController@me');

});



