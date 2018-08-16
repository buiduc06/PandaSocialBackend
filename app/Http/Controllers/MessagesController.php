<?php

namespace App\Http\Controllers;

use App\Messages;
use Illuminate\Http\Request;
use App\Http\Resources\MessageResource;
use Tymon\JWTAuth\Facades\JWTAuth;
class MessagesController extends Controller
{

    public function addMessages(request $request)
    {	
    	$user = JWTAuth::parseToken()->authenticate();
    	$request['user_id'] = $user['id'];
        $data = Messages::create($request->all());
        return response()->json(new MessageResource($data), 200);
    }
    // public function getMessages(request $request)
    // {
    // 	 $user = JWTAuth::parseToken()->authenticate();
    // 	$skip = $request->skip ? $request->skip :0 ;
    //     $data = Messages::where('user_id', $user['id'])->where('friend_id', $request->friend_id)->skip($skip)->take(5)->get();
    //     return response()->json(MessageResource::collection($data), 200);
    // }
}
