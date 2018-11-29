<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class NotificationResource extends Resource
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
            'post_id'       =>$this->post_id,
            'friend_data'   =>$this->getUser(),
            'type'          =>$this->getTypeNotify(),
            'read_status'   =>$this->read_status,
            'total_active'  =>$this->getTotalAction()-1,
        ];
    }
}
