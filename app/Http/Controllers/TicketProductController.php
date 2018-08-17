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

    public function findRoomById(request $request)
    {
        return response()->json(new TicketResource(ticket_product::find($request->id)), 200);
    }
}
