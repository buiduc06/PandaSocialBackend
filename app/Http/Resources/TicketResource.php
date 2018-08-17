<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class TicketResource extends Resource
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
            'id'            =>$this->id,
            'cate_id'       =>$this->id,
            'user_id'       =>$this->user_id,
            'name'          =>$this->name,
            'description'   =>$this->description,
            'price'         =>$this->price,
            'image'         =>$this->image,
            'list_image'    =>$this->list_image,
            'active'        =>$this->active,
            'room_size'     =>$this->room_size,
            'bed'           =>$this->bed,
            'max_people'    =>$this->max_people,
            'wifi'          =>$this->wifi,
            'room_service'  =>$this->room_service,
            'breakfast'     =>$this->breakfast,
            'laundry'       =>$this->laundry,
            'tax_aiport'    =>$this->tax_aiport,
        ];
    }
}
