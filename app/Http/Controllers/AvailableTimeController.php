<?php

namespace App\Http\Controllers;

use App\Services\AvailableTime;
use Illuminate\Http\Request;

class AvailableTimeController extends Controller
{
    /**
     * Provision a new web server.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $availableTime = new AvailableTime();
        return response()->json($availableTime->build($request), 200, [], JSON_NUMERIC_CHECK);
    }
}
