<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class PostResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
     public function toArray($request)
    {
        return [
            'post_id'           => $this->id,
            'summary'           => $this->pms_summary,
            'content'           => $this->pms_content,
            'user_tag_id'       => $this->pms_user_tag_id,
            'location'          => $this->pms_location,
            'post_user_info'    => new UserResource(\App\User::find($this->pms_user_id)),
            'action_with_post'  => $this->getActionPost(),
            'listcomment'       => $this->getCommentPost(),
            'isMyPost'          => $this->checkMyPost(),
            'listImage'         => $this->getListImg(),
        ];
    }
}
