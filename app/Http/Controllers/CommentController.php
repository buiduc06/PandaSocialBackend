<?php

namespace App\Http\Controllers;

use App\comment;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Resources\CommentResource;

class CommentController extends Controller
{
    /**
     * $request
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
    public function deleteComment(request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $dataComment = comment::where('id', $request->comment_id)->where('cm_user_id', $user['id'])->first();
        if (!empty($dataComment)) {
            $dataComment->delete();
            return response()->json(200);
        }
        return response()->json(404);
    }
    public function getMoreComment(request $request)
    {
        $skip = $request->skip;
        $data = comment::where('cm_post_id', $request->post_id)->OrderBy('id', 'DESC')->skip($skip)->take(3)->get();
        if (!empty($data) && count($data)>0) {
            return response()->json(CommentResource::collection($data), 200);
        }
        return response()->json(['msg'=>'hết comment'], 404);
    }
}
