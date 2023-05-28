<?php

namespace App\Http\Controllers\Paciente;


use Carbon\Carbon;
use App\Models\Speciality;
use App\Models\Appointment;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AppointmentService;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreAppointmentRequest;

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
    

    public function index()
    {
        // $appointments = Appointment::with('patient', 'doctor', 'speciality')
        //                 ->where('patient_id', auth()->user()->person->id)
        //                 ->where('status', 'Pendiente')
        //                 ->get();

        $appointments = Appointment::with('patient', 'doctor')
                        ->where('patient_id', auth()->user()->person->id)
                        ->where('status', 'Pendiente')
                        ->get();          

        return view('paciente.citas.index', compact('appointments'));    
    }

    public function cancelarCitas(){
        // $appointments = Appointment::with('patient', 'doctor', 'speciality')
        //                 ->where('patient_id', auth()->user()->person->id)
        //                 ->where('status', 'Pendiente')
        //                 ->get();

        $appointments = Appointment::with('patient', 'doctor')
                        ->where('patient_id', auth()->user()->person->id)
                        ->where('status', 'Pendiente')
                        ->get();


        return view('paciente.citas.cancelar', compact('appointments'));
        

    }
    

    public function create()
    {
        $specialities = Speciality::where('status', 'Activo')->get();

        //get the amount of appointments of the patient
        // $appointments = Appointment::with('patient', 'doctor', 'speciality')
        //                 ->where('patient_id', auth()->user()->person->id)
        //                 ->where('status', 'Pendiente')
        //                 ->get();

        $appointments = Appointment::with('patient', 'doctor')
                        ->where('patient_id', auth()->user()->person->id)
                        ->where('status', 'Pendiente')
                        ->get();         

        if($appointments->count() == 2) {
            notify()->error('No puede agendar más de 2 citas.', 'Error');
            return redirect()->route('home');
        }

        //get the number of appointments of the patient
        $num_appointments = $appointments->count();

        return view('paciente.citas.create', compact('specialities', 'num_appointments'));
    }


    public function store(StoreAppointmentRequest $request)
    {     

        //validate the telephone and email of the patient
        $rules =[
            'telefono' => 'required|numeric|digits:10',
            'email' => 'required|email'
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

        $appointment = Appointment::create($request->all());

        //update the telephone number and email of the patient
        $appointment->patient->update([
            'telefono' => $request->input('telefono')
        ]);

        $appointment->patient->user->update([
            'email' => $request->input('email')
        ]);

        $encrypted_appointment = encrypt($appointment->id);

        // return redirect()->route('paciente.resumen', ['appointment' => $encrypted_appointment])->with('notificacion', 'La cita se ha registrado con éxito');
        return redirect()->route('paciente.resumen', ['appointment' => $encrypted_appointment]);

    }

    public function resumenCita($encrypted_appointment)
    {
        $appointment = Appointment::find(decrypt($encrypted_appointment));

        // $notificacion = session('notificacion');

        notify()->success('Confirmamos que su cita médica ha sido agendada para el día '. $appointment->scheduled_date . ' a las ' . $appointment->scheduled_time . '
                          en la unidad Medica HOSPITAL EL ORO con el Dr. ' . $appointment->doctor->getFullNameAttribute() . ' en el area de ' . Speciality::find($appointment->speciality_id)->name .'.', 
                          'La cita se ha registrado con éxito');

        // return view('paciente.citas.resumen', ['appointment' => $appointment, 'notificacion' => $notificacion]);
        return view('paciente.citas.resumen', ['appointment' => $appointment]);
    }


    public function showPreviewPDF(Request $request)
    {
        // Obtener las citas del paciente
        // $appointments = Appointment::with('patient', 'doctor', 'speciality')
        //                 ->where('patient_id', auth()->user()->person->id)
        //                 ->where('status', 'Pendiente')
        //                 ->get();

        $appointments = Appointment::with('patient', 'doctor')
                        ->where('patient_id', auth()->user()->person->id)
                        ->where('status', 'Pendiente')
                        ->get();              


        $fecha = Carbon::now()->format('Y-m-d H:i:s');
        
        $pdf = PDF::loadView('paciente.citas.previewCitas', compact('appointments', 'fecha'))->setPaper('a4', 'landscape');

        // set font
        $pdf->setOption('defaultFont', 'sans-serif');

        return $pdf->stream('citas.pdf');

    }



    public function show(Appointment $appointment, String $notificacion)
    {
        // $appointment->load('patient', 'doctor', 'speciality');
        $appointment->load('patient', 'doctor');

        // dd($appointment);
        // return view('paciente.citas.show', compact('notificacion', 'appointment'));

        //use redirect
        return redirect()->route('paciente.citas.show', compact('appointment'));

    }
    

    public function edit(Appointment $appointment)
    {
        //
    }


    public function update(Request $request, Appointment $appointment)
    {
        //
    }


    public function destroy($id)
    {

        $appointment = Appointment::find($id);

        $appointment->status = 'Cancelada';
        $appointment->notes = 'Cita cancelada por el paciente';
        $appointment->save();

        notify()->success('La cita se ha cancelado con éxito', 'Cita eliminada');

        //check if there are appointments
        // $appointments = Appointment::with('patient', 'doctor', 'speciality')
        //                 ->where('patient_id', auth()->user()->person->id)
        //                 ->where('status', 'Pendiente')
        //                 ->get();
        $appointments = Appointment::with('patient', 'doctor')
                        ->where('patient_id', auth()->user()->person->id)
                        ->where('status', 'Pendiente')
                        ->get();

        return redirect()->route('paciente.cancelarCitasPaciente', compact('appointments')); 
    }
}
