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

	public function getRequestFriend()
	{
		// lay danh sach loi moi
		$getData = User::join('friend_requests', 'friend_requests.friend_id' , '=', 'users.id')->where('friend_id', $this->useId)->select('friend_requests.*')->get();
		if (!empty($getData) && count($getData)>0) {
			$idd ='';
			foreach ($getData as $keyU) {
				$idd .=$keyU->user_id.',';
			}
			// return response()->json($idd, 200);
			if (count($getData)<= 1) {
				$dta = User::where('id', trim($idd, ','))->get();
				return response()->json(UserResource::collection($dta), 200);
			}else{
				$idArr = array_map('intval', explode(',', trim($idd, ',')));	
				$dta = User::whereIn('id', $idArr)->get();
				return response()->json(UserResource::collection($dta), 200);
			}
		}
		return response()->json($getData);
	}

	public function appendFriends(request $request)
	{
		$getData = FriendRequest::where('user_id', $request->user_id)->where('friend_id', $this->useId)->delete();
		FriendShip::create([
			'user_id' => $request->user_id,
			'friend_id'=> $this->useId
		]);
		FriendShip::create([
			'user_id' => $this->useId,
			'friend_id'=> $request->user_id
		]);
		return response()->json($request->user_id, 200);
	}

	public function miunusFriends(request $request)
	{
		$getData = FriendRequest::where('user_id', $request->user_id)->get();
		return response()->json($request->user_id, 200);
	}
	public function deleteFriends(request $request)
	{
		$getData = FriendShip::where('user_id', $request->user_id)->where('friend_id', $this->useId)->first();
		$getData1 = FriendShip::where('user_id', $this->useId)->where('friend_id', $request->user_id)->first();
		if (!empty($getData) && !empty($getData1)) {
			$getData->delete();
			$getData1->delete();
			return response()->json(['msg'=>'hủy kết bạn thành công'], 200);
		}
		return response()->json(['msg'=>'xóa ko thành công'], 404);
		// hủy kết bạn
	}
	public function cancelFriends(request $request)
	{
		// hủy lời mời kết bạn
		$getData1 = FriendRequest::where('user_id', $this->useId)->where('friend_id', $request->user_id)->first();
		if (!empty($getData1)) {
			$getData1->delete();
			return response()->json(['msg'=>'hủy kết bạn thành công'], 200);
		}
		return response()->json(['msg'=>'xóa ko thành công'], 404);
	}

}
