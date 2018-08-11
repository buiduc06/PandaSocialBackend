<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Facades\JWTAuth;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'uid_user',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getAvatar()
    {
        $avatar = UserMetas::where('user_id', $this->id)->first(['avatar']);
        if (!empty($avatar->avatar)) {
            return url('images/'.$avatar->avatar);
        }
        return url('images/default.png');
    }
//     public function getListIdUserFriends()
//     {
//         // lấy danh sách bạn bè đã gửi lời mời hoặc đã là bạn bè
//      $dataF = FriendShip::where('user_id', $this->id)->select('friend_id')->get();
//      $ckunit =$this->id.',';
//      foreach ($dataF as $dataT) {
//         $ckunit .=$dataT->friend_id.',';
//     }
//     $listIdFriendUsers = array_map('intval', explode(',', trim($ckunit, ',')));
//     return $listIdFriendUsers;
// }

// public function getListRequestFriends()
// {
//        // lấy danh sách bạn bè đã gửi lời mời hoặc đã là bạn bè
//      $dataF = FriendShip::where('friend_id', $this->id)->select('user_id')->get();
//      $ckunit =$this->id.',';
//      foreach ($dataF as $dataT) {
//         $ckunit .=$dataT->user_id.',';
//     }
//     $listIdFriendUsers = array_map('intval', explode(',', trim($ckunit, ',')));
//     return $listIdRequestFriends;
// }

// public function getFriends()
// {
//     // danh sách đã gửi request
//     // lấy ra id khác nhau
//     if (count($this->getListIdUserFriends())> count($this->getListRequestFriends())) {
//         $mainArr = $this->getListIdUserFriends();
//         $deleteAr = $this->getListRequestFriends();
//     }else{
//         $mainArr = $this->getListRequestFriends();
//         $deleteAr = $this->getListIdUserFriends();
//     }
//     $friends = array_diff($mainArr, $deleteAr);
//     return $friends;
// }

// public function getFriends2()
// {
//    // lấy ra các id trùng nhau giữa 2 mảng php
//    // // danh sách tất cả bạn bè đã chấp thuận
//    $data = array_intersect($this->getListIdUserFriends(), $this->getListRequestFriends());

//    return $data;
// }
// 
    public function getListFriends()
    {
        // / lấy danh sách bạn bè 
       $dataFriends = FriendShip::where('user_id', $this->id)->select('friend_id')->get();
       if (!empty($dataFriends) && count($dataFriends)>0) {
           $ckunit ='';
           foreach ($dataFriends as $dataT) {
            $ckunit .=$dataT->friend_id.',';
        }
        $listIdFriendUsers = array_map('intval', explode(',', trim($ckunit, ',')));
        return $listIdFriendUsers;
    }
    return [$this->id];
}

public function getTheInvitationList()
{
    // layDanhSachLoiMoiKetBan

    $dataFriends = FriendRequest::where('friend_id', $this->id)->select('user_id')->get();
    if (!empty($dataFriends) && count($dataFriends)>0) {
        $ckunit ='';
        foreach ($dataFriends as $dataT) {
            $ckunit .=$dataT->user_id.',';
        }
        $listIdFriendUsers = array_map('intval', explode(',', trim($ckunit, ',')));
        return $listIdFriendUsers;
    }
    return [$this->id];
}


public function getListFriendSent()
{
    // layDanhSachDaGuiLoiMoi
    $dataFriends = FriendRequest::where('user_id', $this->id)->select('friend_id')->get();
    if (!empty($dataFriends) && count($dataFriends)>0) {
        $ckunit ='';
        foreach ($dataFriends as $dataT) {
            $ckunit .=$dataT->friend_id.',';
        }
        $listIdFriendUsers = array_map('intval', explode(',', trim($ckunit, ',')));
        return $listIdFriendUsers;
    }
    return [$this->id];
}

public function getListRemoveFriends()
{
        // lấy ra tất cả id đã gửi lời mởi kết bạn , đã là bạn bè hoặc id đó đã gửi cho mình lời kb
    $listIdExclusion = array_unique(array_merge($this->getListFriends(), $this->getTheInvitationList(), $this->getListFriendSent()));
    return $listIdExclusion;
}

public function getListMeta()
{
    return UserMetas::where('user_id', $this->id)->first();
}
public function getDataFriend()
{
    $dataFriends = FriendShip::where('user_id', $this->id)->select('friend_id')->get();
    if (!empty($dataFriends) && count($dataFriends)>0) {
       $ckunit ='';
       foreach ($dataFriends as $dataT) {
        $ckunit .=$dataT->friend_id.',';
    }
    $listIdFriendUsers = array_map('intval', explode(',', trim($ckunit, ',')));

    $data = self::whereIn('id', $listIdFriendUsers)->select('uid_user', 'id', 'name')->get();

    foreach ($data as $value) {
        $dataF[] = [
            'uid_user'  =>$value->uid_user,
            'avatar'    =>$value->getAvatar(),
            'name'      =>$value->name,
        ];
    }
    return $dataF;

}
// }
return '';

}
public function getListImage($num=4)
{
    $data = Gallary::where('user_id', $this->id)->select('image')->limit($num)->get();
    if (!empty($data) && count($data)>0) {
        foreach ($data as $value) {
            $dataGallary[] = url('uploads/'.$value->image);
     }
     return $dataGallary;
 }
 return '';

}

public function isMyProfile()
{
    $user = JWTAuth::parseToken()->authenticate();
    if ($this->id == $user['id']) {
       return true;
    }
    return false;
}

}
