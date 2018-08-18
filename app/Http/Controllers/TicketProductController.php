<?php

namespace App\Http\Controllers;

use App\ticket_product;
use Illuminate\Http\Request;
use App\Http\Resources\TicketResource;

class TicketProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(TicketResource::collection(ticket_product::all()), 200);
    }

    public function findRoomById($id)
    {
        return response()->json(new TicketResource(ticket_product::find($id)), 200);
    }

    public function filterdata(request $request)
    {
        $model = new ticket_product();
        if (!empty($request->children)) {
            $children = $request->children;
        } else {
            $children = 0;
        }
        if (!empty($request->adult)) {
            $model->where('max_people', $request->adult+$children);
        }
        if (!empty($request->typeroom)) {
             $model->where('cate_id', $request->typeroom);
        }
        return response()->json(TicketResource::collection($model->get()), 200);
    }
}
