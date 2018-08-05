<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Resources\CommentResource;
use App\Http\Resources\GallaryResource;
class PostMulti extends Model
{

	protected $fillable = [
		'pms_user_id', 'pms_summary', 'pms_content','pms_location', 'pms_user_tag_id', 'pms_list_image','pms_type','pms_status'
	];

	public function getActionPost()
	{
		$data = actionWithPost::where('awp_post_id', $this->id)->first(['awp_like', 'awp_share', 'awp_comment', 'awp_list_user_like']);
		// check xem user đã like chưa
		$user = JWTAuth::parseToken()->authenticate();
		if (!empty($data->awp_list_user_like)) {
			$checkUserLike = in_array($user['id'], explode(',', $data->awp_list_user_like));
		}else{
			$checkUserLike = false;
		}
		return [
			'awp_like'		=> $data->awp_like,
			'awp_share'		=> $data->awp_share,
			'awp_comment'	=> $this->countComment(),
			'isMyLiked'		=> $checkUserLike,
		];
	}

	public function getCommentPost()
	{
		$data = comment::where('cm_post_id', $this->id)->OrderBy('id', 'DESC')->skip(0)->take(3)->get();
		if (!empty($data) && count($data)>0) {
			return CommentResource::collection($data);
		}
		return null;
	}
	public function checkMyPost()
	{
		$user = JWTAuth::parseToken()->authenticate();
		if ($this->pms_user_id == $user['id']) {
			return true;
		}
		return false;
	}
	public function getListImg()
	{
		$checkGallary = Gallary::where('post_id', $this->id)->select('image')->get();
		if (!empty($checkGallary) && count($checkGallary) >0) {
			return GallaryResource::collection($checkGallary);
		}
		return null;
	}

	public function countComment()
	{
		$data = comment::where('cm_post_id', $this->id)->count();
		return $data;
	}
}
