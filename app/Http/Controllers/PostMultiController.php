<?php

namespace App\Http\Controllers;

use App\PostMulti;
use App\Notification;
use App\comment;
use App\actionWithPost;
use App\Gallary;
use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;

class PostMultiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public $useId;

    function __construct()
    {
        $user = JWTAuth::parseToken()->authenticate();
        if (!$user) {
            return response()->json(404);
        } else {
            $this->useId = $user['id'];
        }
    }

    public function getNewsFeed(request $request)
    {
        // lấy bài viết của chính bạn và bạn bè của bạn
        if (isset($request['page']) && !empty($request['page'])) {
            $taken = $request['page'];
        } else {
            $taken = 0;
        }
        $listFriend = User::find($this->useId);
        $listArrIdFriend = array_merge($listFriend->getListFriends(), [$this->useId]);
        if (count($listArrIdFriend)>=2) {
            $data = PostResource::collection(PostMulti::whereIn('pms_user_id', $listArrIdFriend)->OrderBy('id', 'DESC')->skip($taken)->take(5)->get()->shuffle());
        } else {
            $data = PostResource::collection(PostMulti::where('pms_user_id', $this->useId)->OrderBy('id', 'DESC')->skip($taken)->take(5)->get());
        }
        return response()->json($data, 200);
    }

    public function getNewsFeedByUid_user(request $request)
    {
        // lấy bài viết của chính bạn và bạn bè của bạn
        if (isset($request['page']) && !empty($request['page'])) {
            $taken = $request['page'];
        } else {
            $taken = 0;
        }
        $listFriend = User::where('uid_user', $request['uid_user'])->first();
        $data = PostResource::collection(PostMulti::where('pms_user_id', $listFriend->id)->OrderBy('id', 'DESC')->skip($taken)->take(5)->get());
        return response()->json($data, 200);
    }


    public function postNewsFeed(request $request)
    {
        $data =  PostMulti::create([
            'pms_user_id'       => $this->useId,
            'pms_summary'       => $request->summary,
            'pms_content'       => $request->content,
            'pms_user_tag_id'   => $request->user_tag_id,
            'pms_location'      => $request->location,
            'pms_type'          => $request->type,
            'pms_status'        => $request->status,
            'pms_list_image'     => $request->selectedFile,
        ]);
        actionWithPost::create([
            'awp_post_id' => $data->id,
        ]);
        $data1 = new PostResource(PostMulti::find($data->id));
        return response()->json($data1);
    }


    public function updateActionStatus(request $request)
    {
        $table = [
            'like'=> 'awp_like',
            'comment'=> 'awp_comment',
            'share'=> 'awp_share',
        ];
        $column = $table[$request->type];
        $data = actionWithPost::where('awp_post_id', $request->idPost)->first();

        if ($column == 'awp_like') {
            if (empty($data)) {
                return response()->json($request->idPost, 404);
            }

            $listLike = array_map('intval', explode(',', $data->awp_list_user_like));
            $checkExit = in_array($this->useId, $listLike);
            if ($checkExit) {
                $listUserLike = array_diff($listLike, [$this->useId]);
                $numberLike = $data->$column == 0? 0 :$data->$column-1;
            } else {
                if (count($listLike)>0 && !empty($listLike) && $listLike!=[0]) {
                    $listUserLike = array_merge($listLike, [$this->useId]);
                } else {
                    $listUserLike = [$this->useId];
                }
                $numberLike = $data->$column+1;
            }

            if ($data->getUserIdByPost() != $this->useId) {
                $checkNotify = Notification::where('post_id', $request->idPost)->where('type', 'like')->first();
                if (!empty($checkNotify)) {
                    $notify = $checkNotify->update([
                        'friend_id'     => $this->useId,
                    ]);
                } else {
                    $notify = Notification::create([
                        'post_id'       => $request->idPost,
                        'friend_id'     => $this->useId,
                        'user_id'       => $data->getUserIdByPost(),
                        'type'          => 'like',
                        'read_status'   => 0,
                    ]);
                }
            }
            $data->update([
                $column => $numberLike,
                'awp_list_user_like' => trim(implode(',', $listUserLike), ','),
            ]);
        } else {
            $data->update([
                $column => $data->$column+1,
            ]);
        }
        return response()->json(['column' => $column, 'quantity'=> $data->$column], 200);
    }

    public function deletePost(request $request)
    {
        $deleteAction = actionWithPost::where('awp_post_id', $request->id)->first();
        $deleteComment = comment::where('cm_post_id', $request->id)->first();
        if ($deleteAction) {
            $deleteAction->delete();
        }
        if ($deleteComment) {
            $deleteComment->delete();
        }

        $checkdata = PostMulti::findOrFail($request->id)->delete();
        return response()->json($request->id);
    }

    public function getMyPost()
    {
        $data =  PostResource::collection(PostMulti::where('pms_user_id', $this->useId)->OrderBy('id', 'DESC')->get());

        return response()->json($data, 200);
    }

    public function getPostByUid(request $uid_user)
    {
        $checkUser = User::where('uid_user', $uid_user['uid_user'])->first();
        if (!$checkUser) {
            return response()->json($checkUser, 500);
        }
        $data = PostResource::collection(PostMulti::where('pms_user_id', $checkUser->id)->OrderBy('post_multis.id', 'DESC')->get());
        return response()->json($data, 200);
    }

    public function updatePost(request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string',
        ], [
            'content.required'=>'nội dung không được để trống',
            'content.string'=>'nội dung phải là string',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
        }

        $update = PostMulti::findOrFail($request->post_id);
        $update->update([
            'pms_content' => $request->content
        ]);

        return response()->json($update, 200);
    }
}
