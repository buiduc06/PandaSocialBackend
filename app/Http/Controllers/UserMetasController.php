<?php

namespace App\Http\Controllers;

use App\UserMetas;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserMetasController extends Controller
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

	public function changeMyInfo(request $request)
	{
		$dataUser = UserMetas::where('user_id', $this->useId)->first();
		$UpdateUser = User::find($this->useId);
		$UpdateUser->update([
			'name'=>$request->lastname.' '.$request->firstname,
		]);
		$dataUser->update($request->all());
		return response()->json($request, 200);
	}
	public function getMetaMyInfo()
	{
		$dataUser = UserMetas::where('user_id', $this->useId)->first();
		return response()->json($dataUser, 200);
	}
}
