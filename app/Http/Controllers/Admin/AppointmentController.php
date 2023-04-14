<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Person;
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
        $this->middleware('can:appointment-list')->only('index');
        $this->middleware('can:appointment-create')->only('create', 'store');
        $this->middleware('can:appointment-edit')->only('edit', 'update');
        $this->middleware('can:appointment-delete')->only('destroy');
        $this->middleware('can:appointment-show')->only('show');

        $this->appointmentService = $appointmentService;
    }


    public function index(Request $request)
    {
        $appointments = Appointment::with('patient:id,nombres,apellidos,cedula', 'doctor:id,nombres,apellidos', 'speciality:id,name')
                ->select('id', 'patient_id', 'doctor_id', 'speciality_id', 'scheduled_time', 'scheduled_date', 'status', 'notes');
    

        if ($request->ajax()) {

                return DataTables::of($appointments)
                    ->addColumn('actions', function ($appointment) {
                        $edit = '';
                        $delete = '';
                        $show = '';

                        // if (auth()->user()->can('user-show')) {
                        //     $show = '<a href="' . route('admin.users.show', $appointment->id) . '" class="show btn btn-info btn-sm">
                        //                     <i class="fa fa-fw fa-eye"></i>
                        //             </a>';
                        // }
                        if (auth()->user()->can('appointment-reprogramar')) {
                            $edit = '<a href="' . route('admin.appointments.edit', $appointment->id) . '" class="edit btn btn-warning btn-sm">
                                            <i class="fa fa-fw fa-edit"></i>
                                    </a>';
                        }
                        if (auth()->user()->can('appointment-delete')) {
                            $delete = '
                                    <form action="' . route('admin.appointments.destroy', $appointment->id) . '" method="POST" class="d-inline eliminarUsuario">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></button>
                                    </form>';
                        }

                        return $show . ' ' . $edit . ' ' . $delete;
                    })
                    ->addColumn('doctor', function ($appointment) {
                        return $appointment->doctor->nombres . ' ' . $appointment->doctor->apellidos;
                    })
                    ->filter(function ($appointment) use ($request) {

                        if ($request->has('status_id') && $request->get('status_id') != '') {
                            $appointment->where('status', $request->get('status_id'));
                        }      
                        
                        if ($request->has('start_date') && $request->get('start_date') != '') {
                            $appointment->where('scheduled_date', '=', $request->get('start_date'));
                        }

                    })
                ->rawColumns(['actions'])
                ->make(true);
        }
         return view('admin.appointments.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        $cedula = $request->input('cedula');

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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        $appointment->load('patient', 'doctor', 'speciality');

        return view('admin.appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {

        // Bring all the specialities that are Activo
        $specialities = Speciality::where('status', 'Activo')->get();
        
        // Look for the patient and doctor
        // $paciente = Person::find($appointment->patient_id);
        $doctorCita = Person::find($appointment->doctor_id);

        // Bring the persons that have specialities
        //$doctors = Person::whereHas('specialities')->get();

        // Bring the doctors that have the same specialities
        $doctors = Person::whereHas('specialities', function ($query) use ($appointment) {
            $query->where('speciality_id', $appointment->speciality_id);
        })->get();


        // Look for the patient and retrieve id, nombres, apellidos and cedula:
        $paciente = Person::where('id', $appointment->patient_id)->select('id', 'nombres', 'apellidos', 'cedula')->first();


        return view('admin.appointments.edit', compact('appointment', 'specialities', 'paciente', 'doctorCita', 'doctors'));
    }


    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        $appointment->update($request->all());

        return redirect()->route('admin.appointments.edit', $appointment)->with('success', 'La cita se actualizó con éxito');

        //return redirect()->route('admin.appointments.index')->with('success', 'La cita se actualizó con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('admin.appointments.index')->with('success', 'La cita se eliminó con éxito');
    }
}
