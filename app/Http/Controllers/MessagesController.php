<?php

namespace App\Http\Controllers;

use App\Messages;
use Illuminate\Http\Request;
use App\Http\Resources\MessageResource;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\User;
use Auth;
use App\Http\Resources\UserResource;

class MessagesController extends Controller
{

    public function addMessages(request $request)
    {
        
        $user = JWTAuth::parseToken()->authenticate();
        $data = Messages::create([
            'user_id'=> $user['id'],
            'friend_id'=> User::where('uid_user', $request->uid_user)->select('id')->first()->id,
            'messages'=> $request->message,
        ]);
        return response()->json(new MessageResource($data), 200);
    }
    public function getMessages(request $request)
    {
        // $user = JWTAuth::parseToken()->authenticate();
        // $skip = $request->skip ? $request->skip :0 ;
        // $data = Messages::get();
        // $data_friend = User::find($user['id'])->getListFriends();
      
        $data_only= User::find(24);
        $data_friend = $data_only->getListFriends();
        $data_resourse = User::whereIn('id', $data_friend)->get();
         
        foreach ($data_resourse as $item) {
            $data_message[] = [
                'user'=> new UserResource($data_only),
                'message'=> $data_only->message($item->id),
                'uid_user'=>$item->uid_user,
                'channel'=>(int) $item->uid_user+(int) $data_only->uid_user
            ];
        }
 
       
        return response()->json($data_message, 200);
    }
}
