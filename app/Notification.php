<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'post_id', 'friend_id', 'type', 'read_status', 'user_id', 'total'
    ];

    public function getTypeNotify()
    {
        if ($this->type == "comment") {
            return 'Bình luận';
        }
        if ($this->type == "like") {
            return 'Thích';
        }
    }

    public function getUser()
    {
        $user = User::find($this->friend_id);
        return [
            'name' => $user->name,
            'avatar' => $user->getAvatar(),
            'uid_user' => $user->uid_user,
        ];
    }
    public function getTotalAction()
    {
        $action = actionWithPost::where('awp_post_id', $this->post_id)->first(['awp_like', 'awp_share', 'awp_comment']);
        if ($this->type == 'comment') {
            return $action->awp_comment;
        } else {
            return $action->awp_like;
        }
    }
}
