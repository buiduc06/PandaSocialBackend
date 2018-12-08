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

Route::group(['middleware' => 'jwt.auth'], function () {



    Route::prefix('Feed')->group(function () {
        Route::any('getNewsFeed', 'PostMultiController@getNewsFeed');
        Route::any('getNewsFeedByUidUser', 'PostMultiController@getNewsFeedByUid_user');
        Route::post('postNewsFeed', 'PostMultiController@postNewsFeed');
        Route::post('updateActionStatus', 'PostMultiController@updateActionStatus');
        Route::post('deletePost', 'PostMultiController@deletepost');
        Route::post('updatePost', 'PostMultiController@updatePost');
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
        Route::post('getDataUserByUid', 'AuthController@getDataUserByUid');
        Route::post('uploadImage', 'GallaryController@uploadImage');
        Route::post('addCommentToPost', 'CommentController@addCommentToPost');
        Route::get('getRequestFriend', 'FriendShipController@getRequestFriend');
        Route::post('appendFriends', 'FriendShipController@appendFriends');
        Route::post('miunusFriends', 'FriendShipController@miunusFriends');
        Route::post('deleteFriends', 'FriendShipController@deleteFriends');
        Route::post('cancelFriends', 'FriendShipController@cancelFriends');
        Route::post('searchUser', 'AuthController@searchUser');
        Route::get('getListFriends', 'AuthController@getListFriends');
        Route::post('changePassword', 'AuthController@changePassword');
        Route::post('changeAvatar', 'AuthController@changeAvatar');
        Route::post('changeMyInfo', 'UserMetasController@changeMyInfo');
        Route::get('getMetaMyInfo', 'UserMetasController@getMetaMyInfo');
        Route::post('deleteComment', 'CommentController@deleteComment');
        Route::post('getMoreComment', 'CommentController@getMoreComment');
        Route::post('addMessages', 'MessagesController@addMessages');
        Route::get('getMessages', 'MessagesController@getMessages');
        Route::get('getNotification', 'NotificationController@index');
        Route::post('changeStatusOnline', 'AuthController@changeStatusOnline');
    });

    Route::post('getMyInfo', 'AuthController@me');
    Route::get('getMyInfo', 'AuthController@me');
});
