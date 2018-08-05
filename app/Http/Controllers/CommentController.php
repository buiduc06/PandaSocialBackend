<?php

namespace App\Http\Controllers;

use App\comment;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Resources\CommentResource;
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addCommentToPost(request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $dataComment = comment::create([
            'cm_user_id'=> $user['id'],
            'cm_post_id'=> $request['post_id'],
            'cm_content'=> $request['comment'],
            'cm_image'  => '',
        ]);
        $dataC = new CommentResource($dataComment);

        return response()->json($dataC, 200);
    }

}
