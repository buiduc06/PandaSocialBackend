<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class UserResource extends Resource
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
            'uid_user'  => (int) $this->uid_user,
            'avatar'    => $this->getAvatar(),
            'cover'    => $this->getCover(),
            'isMydata'  => $this->isMyProfile(),
            'generalFriends' =>$this->generalFriends(),
            'isMyfriends'=>$this->isMyfriends(),
            'channel'=> $this->getPrivateChannel()
        ];
    }
}
