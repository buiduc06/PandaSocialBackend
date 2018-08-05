<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class CommentResource extends Resource
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
            'content'   =>$this->cm_content,
            'image'     =>$this->cm_image,
            'user_data' =>$this->getUserComment(),
            'post_id'   =>$this->cm_post_id,
        ];
    }
}
