<?php

namespace App\Http\Controllers;

use App\FriendShip;
use App\FriendRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Resources\UserResource;
class FriendShipController extends Controller
{
	public $useId;


	function __construct()
	{
		$user = JWTAuth::parseToken()->authenticate();
		if (!$user) {
			return response()->json(404);
		}else{
			$this->useId = $user['id'];
		}
	}

	public function getListFriendNotFriendShip()
	{

		$findUser = User::find($this->useId);
		$data_user = User::whereNotIn('users.id', $findUser->getListRemoveFriends())
		->where('users.id', '!=', $this->useId)
		->OrderBy('users.id', 'DESC')->get();
		return response()->json(UserResource::collection($data_user));

	}

	public function makefriend(request $request)
	{
		$datacheck = FriendRequest::where('user_id','=' ,$this->useId)->where('friend_id', '=', $request->user_id)->first();
		if(!empty($datacheck) && count($datacheck)>0){
			return response()->json($request->user_id);
		}else{
			FriendRequest::create([
				'user_id' 	=> 	$this->useId,
				'friend_id'	=>	$request->user_id
			]);

			return response()->json($request->user_id);
		}
	}

	public function confirmFriend(request $request)
	{
		// đồng ý kết bạn
		$datacheck = FriendRequest::where('friend_id','=' ,$this->useId)->where('user_id', '=', $request->user_id)->first();

		if(!empty($datacheck) && count($datacheck)>0){
			return response()->json($request->user_id, 404);
		}else{
			FriendShip::create([
				'user_id' 	=> 	$this->useId,
				'friend_id'	=>	$request->user_id
			]);
			FriendShip::create([
				'friend_id' => 	$this->useId,
				'user_id'	=>	$request->user_id
			]);
			$datacheck->delete();
			return response()->json($request->user_id);
		}
	}
	public function deleteRequestFriend(request $request)
	{
		// xóa bỏ lời mời kết bạn
		$datacheck = FriendRequest::where('friend_id','=' ,$this->useId)->where('user_id', '=', $request->user_id)->delete();
	}


}
