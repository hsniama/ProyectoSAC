<?php

namespace App\Http\Controllers\Secretaria;

use App\Models\User;
use App\Models\Person;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePatientRequest;
use App\Services\PatientService;
use Yajra\DataTables\DataTables; // yo agregue esta

class PatientController extends Controller
{
    protected $pacientService;
    
    public function __construct(PatientService $pacientService)
    {
        $this->middleware('can:paciente-list')->only('index');
        $this->middleware('can:paciente-create')->only('create', 'store');
        // $this->middleware('can:paciente-edit')->only('edit', 'update');
        // $this->middleware('can:paciente-delete')->only('destroy');
        $this->middleware('can:paciente-show')->only('show');

        $this->pacientService = $pacientService;
    }

    public function index(Request $request)
    {
        // ------------------------------------------------------------------------------------------------
        // Cuarta Forma: la mas optimizada
        //  $personsRolPaciente = Person::whereHas('user.roles', function ($query) {
        //     $query->where('name', 'paciente');
        //  })->with('user')->get();
        /*
        This will retrieve all 'Person' records that have a related 'User' model with a role named 'secretaria'
        directly from the database, without the need for the foreach loop.
        This way you are saving time and memory by not having to iterate over all the pacientes and check if they
        have the role of secretaria.
        */

        // return view('secretaria.pacientes.index', compact('personsRolPaciente'));

        if($request->ajax()){
            // select all the users that are active and have the role of 'paciente'
            // $pacientes = Person::whereHas('user.roles', function ($query) {
            //     $query->where('name', 'paciente');
            // })->with('user')->get();

            $pacientes = Person::with('user:username,email')
                        ->whereHas('user.roles', function ($query) {
                            $query->where('name', 'paciente');
                        })->select('id', 'cedula', 'apellidos', 'nombres', 'fecha_nacimiento', 'genero')->get();

            return DataTables::of($pacientes)
                        ->addColumn('actions', function ($paciente){
                            $show = '<a href="' . route('secretaria.pacientes.show', $paciente->id) . '" class="show btn btn-info btn-sm">
                                        <i class="fa fa-fw fa-eye"></i>
                                </a>';
                            return $show;
                        
                            })
                        ->addColumn('nombres', function($paciente){
                            return $paciente->getFullNameAttribute();
                        })
                        ->rawColumns(['username', 'actions'])
                        ->make(true);   
        }

        return view('secretaria.pacientes.index');
    }


    

    public function create()
    {
        return view('secretaria.pacientes.create');
    }


    public function store(StorePatientRequest $request)
    {
        $user = $this->pacientService->createPatient($request);

        $paciente = Person::where('user_id', $user->id)->first();
     
        return view('secretaria.pacientes.creedenciales', compact('user', 'paciente'))->with('success', 'El paciente se creó con éxito');
    }

    public function show(Person $paciente)
    {

        // Regla de negocio: Calcular la edad de la person.
        $edad = \Carbon\Carbon::parse($paciente->fecha_nacimiento)->age;

        return view('secretaria.pacientes.show', compact('paciente', 'edad'));
    }

    public function imprimirCreedenciales(Request $request)
    {
        // Bring only username and email from request
        $username = $request->username;
        $nombres = $request->nombres;
        $apellidos = $request->apellidos;
        $password = 'password';
        $fecha = date('d-m-Y');

        // print data to pdf
        $pdf = PDF::loadView('secretaria.pacientes.print-creedentials', compact('username', 'nombres', 'apellidos', 'password', 'fecha'))
                ->setPaper('a4', 'portrait');

        return $pdf->download('creedenciales'.$username.time().'.pdf');
    }
}
