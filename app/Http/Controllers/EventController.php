<?php namespace App\Http\Controllers;

use App\Http\Controllers\Base\ControllerResponses;
use App\Http\Controllers\Base\RestController;
use Illuminate\Http\Request;

class EventController extends RestController
{

    public function __construct()
    {

    }

    function getRepository()
    {

    }

    public function store(Request $request)
    {
        return response()->json(ControllerResponses::okResp($request->all()));
    }
}