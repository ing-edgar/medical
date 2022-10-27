<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     * this is a collection
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = Appointment::with(['patient' => function ($query) {
            $query->select('id', 'name');
        }, 'user' => function ($query) {
            $query->select('id', 'name');
        }, 'appointment_status' => function ($query) {
            $query->select('id', 'name');
        }, 'payment_status' => function ($query) {
            $query->select('id', 'name');
        }])->get();
        return Inertia(component: 'Appointment', props: compact('appointments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
