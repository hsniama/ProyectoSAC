<?php

namespace App\Http\Controllers\Secretaria;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Person;
use App\Models\VitalSign;
use App\Models\Speciality;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Services\AppointmentService;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Http\Controllers\Controller; // yo agregue esta

class AppointmentController extends Controller
{

    protected $appointmentService;

    public function __construct(AppointmentService $appointmentService)
    {
        // $this->middleware('can:appointment-list')->only('index');
        $this->middleware('can:appointment-create')->only('create', 'store');
        // $this->middleware('can:appointment-edit')->only('edit', 'update');
        // $this->middleware('can:appointment-delete')->only('destroy');
        // $this->middleware('can:appointment-show')->only('show');
        $this->appointmentService = $appointmentService;
    }


    public function create()
    {

        $patients = User::with('person')->whereHas('roles', function ($query) {
            $query->where('name', 'paciente');
        })->where('status', 'Activo')->get();

        $specialities = Speciality::where('status', 'Activo')->get();

        return view('admin.appointments.create', compact('patients', 'specialities'));
    }



    public function store(StoreAppointmentRequest $request)
    {

        $cedula = $request->input('cedulaPaciente');

        //buscar el usuario con la cedula
        $user = User::whereHas('person', function ($query) use ($cedula) {
            $query->where('cedula', $cedula);
        })->first();


        //validate the telephone and email of the patient
        $rules =[
            'telefono' => 'required|numeric|digits:10',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ];

        $validator = Validator::make($request->only('telefono', 'email'), $rules);

        $validator->after(function ($validator) use ($request) {

            $date = $request->input('scheduled_date');
            $doctorId = $request->input('doctor_id');
            $scheduled_time = new Carbon($request->input('scheduled_time'));

            if($this->appointmentService->isAvailableInterval($date, $doctorId, $scheduled_time) == false) {
                $validator->errors()->add('scheduled_time', 'La hora seleccionada ya se encuentra ocupada. Acaba de ser seleccionada por otro usuario.');
            }

            if ($request->input('telefono') == $request->input('email')) {
                $validator->errors()->add('telefono', 'El telefono y el email no pueden ser iguales');
            }
        });

        // show the validation error messages
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $appointment = Appointment::create([
            'patient_id' => $user->person->id,
            'doctor_id' => $request->input('doctor_id'),
            'speciality_id' => $request->input('speciality_id'),
            'scheduled_time' => $request->input('scheduled_time'),
            'scheduled_date' => $request->input('scheduled_date'),
            'status' => $request->input('status'),
            'notes' => $request->input('notes'),
        ]);
        VitalSign::create([
            'appointment_id' => $appointment->id,
        ]);

        //update the telephone number and email of the patient
        $appointment->patient->update([
            'telefono' => $request->input('telefono')
        ]);

        if($user->email != $request->input('email')) {
            $user->update([
                'email' => $request->input('email')
            ]);
        }

        notify()->success('La cita se creó con éxito', 'Cita médica creada con éxito');


        return redirect()->route('admin.appointments.index');
    }

}
