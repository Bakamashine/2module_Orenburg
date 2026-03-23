<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function getUserOrder(Request $request)
    {
        return OrderResource::collection($request->user()->order()->get());
    }
}
