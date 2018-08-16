<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ProfileUserResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'email'     => $this->email,
            'uid_user'  => $this->uid_user,
            'avatar'    => $this->getAvatar(),
            'metaUser'  =>$this->getListMeta(),
            'listFriends'=>$this->getDataFriend(),
            'listImgUpload'=>$this->getListImage(6),
            'isMyProfile'=>$this->isMyProfile(),
            'isMyfriends'=>$this->isMyfriends(),
        ];
    }
}
