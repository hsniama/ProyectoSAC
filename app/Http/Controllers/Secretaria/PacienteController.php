<?php

namespace App\Http\Controllers\Secretaria;

use App\Models\User;
use App\Models\Persona;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PacienteController extends Controller
{

    //create static variable
    public $usuarioGuardado;
    public $pacienteGuardado;
    
    //create invoke method
    public function __invoke()
    {
        //return view('paciente.create');
    }
    
    public function __construct(){
        $this->middleware('can:paciente-list')->only('index');
        $this->middleware('can:paciente-create')->only('create', 'store');
        // $this->middleware('can:paciente-edit')->only('edit', 'update');
        // $this->middleware('can:paciente-delete')->only('destroy');
        $this->middleware('can:paciente-show')->only('show');
    }

    public function index()
    {
        //$users = User::role('paciente')->get();      

        $pacientes = Persona::with('user')->get();

        $personasRolPaciente = [];

        foreach ($pacientes as $paciente) {
            if($paciente->user->hasRole('paciente')){
                $personasRolPaciente[] = $paciente;
            }
        }
       

        return view('secretaria.pacientes.index', compact('personasRolPaciente'));
    }


    

    public function create()
    {
        // Necesito saber a que usuario le voy  a crear la persona
        $users = User::all();

        return view('secretaria.pacientes.create', compact('users'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:15', 'unique:users,username', 'alpha_dash'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            //'password' => ['required', 'string', 'min:8', 'confirmed'],
            'cedula' => ['required', 'string', 'max:255', 'unique:personas,cedula'],
            'apellidos' => ['required', 'string', 'max:255'],
            'nombres' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string', 'max:255'],
            'direccion' => ['required', 'string', 'max:255'],
            'ciudad' => ['required', 'string', 'max:255'],
            'fecha_nacimiento' => ['required', 'date'],
            'genero' => ['required', 'string', 'max:255'],
        ]);

        $password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; //password

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' =>$password, //password,
        ])->assignRole('paciente');

        $paciente = Persona::create([
            'user_id' => $user->id,
            'cedula' => $request->cedula,
            'apellidos' => $request->apellidos,
            'nombres' => $request->nombres,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'ciudad' => $request->ciudad,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'genero' => $request->genero,
        ]);

        return redirect()->route('secretaria.creedenciales', compact('user'))->with('success', 'El paciente se creó con éxito');   
    }


    public function creedenciales($id)
    {
        $user = User::find($id);

        return view('secretaria.pacientes.creedenciales', compact('user'));
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
