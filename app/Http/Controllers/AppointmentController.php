<?php

namespace App\Http\Controllers;

use App\Mail\CreatedAppointment;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;
use App\Repositories\AppointmentsRepository;
use App\Services\Status\Confirmed;
use App\Services\Status\Registered;
use App\Services\Status\Unpaid;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Inertia\ResponseFactory;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     * this is a collection
     * @return \Inertia\Response|ResponseFactory
     */
    public function index(): \Inertia\Response|ResponseFactory
    {
        $appointments = Appointment::with(['patient' => function ($query) {
            $query->select('id', 'name');
        }, 'user' => function ($query) {
            $query->select('id', 'name');
        }])->get();

        return Inertia(component: 'Appointment', props: compact('appointments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $this->validations($request->all())->validate();
        $user = User::findOrFail($request->user_id);
        $patient = Patient::where('rfc', $request->patient_data['rfc'])->first();
        if (!$patient)
            $patient = Patient::create($request->patient_data);
        $appointment = $user->addAppointment($patient->id, [
            'date' => $request->date,
            'start_time' => $request->intervals['start_time'],
            'end_time' => $request->intervals['end_time'],
            'appointment_status' => Registered::class,
            'payment_status' => Unpaid::class
        ]);
        Mail::to($patient->email)->send(new CreatedAppointment($patient, $appointment->id));

        return response()->json('Se ha creado exitósamente la cita. Un correo electrónico se enviará a tu cuenta, allí debes confirmarla ', 201);
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
            'date.required' => 'Se requiere la fecha de la cita',
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
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

    public function getList(Request $request)
    {
        $appointmentsRepository = new AppointmentsRepository();
        $appointments = $appointmentsRepository->getList($request->user_id, $request->query('date'));
        return response()->json($appointments);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function confirmation(string $id)
    {
        $appointment = Appointment::find($id);
        $appointment->appointment_status = Confirmed::class;
        $appointment->update();

        return Inertia(component: 'ConfirmedAppointment', props: ['La cita fue confirmada con éxito']);
    }
}
