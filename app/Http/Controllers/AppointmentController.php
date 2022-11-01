<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;
use App\Repositories\AppointmentsRepository;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
        $this->validations($request->all())->validate();
        $user = User::findOrFail($request->user_id);
        $patient = Patient::where('rfc', $request->patient_data['rfc'])->first();
        if (!$patient)
            $patient = Patient::create($request->patient_data);
        $user->addAppointment($patient->id, [
            'date' => $request->date,
            'start_time' => $request->intervals['start_time'],
            'end_time' => $request->intervals['end_time']
        ]);

        $request->session()->flash('success', 'Cita creada exitosamente');

        return response()->json(['success' => true, 'url' => '/admin/appointments'], 201);
    }

    private function validations($values)
    {
        // Validar los campos.
        $messages = [
            'patient_data.name.required' => 'El nombre del paciente es requerido',
            'patient_data.rfc.required' => 'El rfc del paciente es requerido',
            'patient_data.email.required' => 'El email del paciente es requerido',
            'patient_data.email.email' => 'El campo email no está bien formado',
            'patient_data.phone.required' => 'El teléfono del paciente es requerido',
            'date.required' => 'Se requiere de la fecha de la cita',
            'intervals.start_time.required' => 'No existe hora de la cita',
            'user_id' => 'No ha escogido un profesional'
        ];
        return Validator::make($values, [
            'user_id' => 'required|exists:users,id',
            'patient_data.name' => 'required',
            'patient_data.rfc' => 'required',
            'patient_data.email' => 'required|email',
            'patient_data.phone' => 'required',
            'date' => 'required',
            'intervals.start_time' => 'required',
        ], $messages);
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

    public function getAppointmentsCount(Request $request)
    {
        $appointmentsRepository = new AppointmentsRepository();
        return response()->json($appointmentsRepository->getCount($request->user_id));
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
