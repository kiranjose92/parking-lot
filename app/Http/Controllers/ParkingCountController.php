<?php

namespace App\Http\Controllers;

use App\ParkingCount;
use Illuminate\Http\Request;


class ParkingCountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $parkingCountObj = new ParkingCount();
        $parkingSlots = $parkingCountObj->getParkingStatus($request->all());
        return response()->json($parkingSlots);
    }
}
