<?php

namespace App\Http\Controllers;

use App\Models\Weekday;
use App\Http\Requests\StoreWeekdayRequest;
use App\Http\Requests\UpdateWeekdayRequest;

class WeekdayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $weekdays = Weekday::all();
        return response()->json($weekdays);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWeekdayRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWeekdayRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Weekday  $weekday
     * @return \Illuminate\Http\Response
     */
    public function show(Weekday $weekday)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Weekday  $weekday
     * @return \Illuminate\Http\Response
     */
    public function edit(Weekday $weekday)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWeekdayRequest  $request
     * @param  \App\Models\Weekday  $weekday
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWeekdayRequest $request, Weekday $weekday)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Weekday  $weekday
     * @return \Illuminate\Http\Response
     */
    public function destroy(Weekday $weekday)
    {
        //
    }
}
