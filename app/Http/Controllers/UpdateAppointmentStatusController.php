<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class UpdateAppointmentStatusController extends Controller
{
    public function cancel(Request $request)
    {
        $appointment = Appointment::with('patient')->find($request->uuid);
        $status = $appointment->appointment_status;
        $status = new $status($appointment);
        return $status->cancel();
    }
    public function register(Request $request)
    {
        $appointment = Appointment::find($request->uuid);
        $status = $appointment->appointment_status;
        $status = new $status($appointment);
        return $status->register();
    }
    public function confirm(Request $request)
    {
        $appointment = Appointment::find($request->uuid);
        $status = $appointment->appointment_status;
        $status = new $status($appointment);
        return $status->confirm();
    }

    public function complete(Request $request)
    {
        $appointment = Appointment::find($request->uuid);
        $status = $appointment->appointment_status;
        $status = new $status($appointment);
        return $status->complete();
    }

    public function paid(Request $request){
        $appointment = Appointment::find($request->uuid);
        $status = $appointment->payment_status;
        $status = new $status($appointment);
        return $status->paid();
    }
}
