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
        //----------------------------------------------------------------------------------------------
        // Primera forma: no me sirvio aqui no se por que.
        // $pacientes = Persona::with([
        //     'user' => function($query){
        //         $query->whereHas('roles', function($query){
        //             $query->where('name', 'admin');
        //         });
        //     }
        // ])->get();
        // dd($pacientes);

        //----------------------------------------------------------------------------------------------

        //Segunda forma: Es buena pero consume mucha memoria ya que itero todas las personas para saber
        //quien tiene dicho rol que estoy buscando.

        // $pacientes = Persona::with('user')->get(); Pertenece a la segunda forma
        // $personasRolPaciente = [];

        // foreach ($pacientes as $paciente) {
        //     if($paciente->user->hasRole('secretaria')){
        //         $personasRolPaciente[] = $paciente;
        //     }
        // }

        // ------------------------------------------------------------------------------------------------
        // Tercera forma: Excelente, sirve muy bien, sirve para entender un poquito mas.
        // $personasRolPaciente = Persona::whereHas('user', function($query){
        //     $query->whereHas('roles', function($query){
        //         $query->where('name', 'paciente');
        //     });
        // })->get();

        // ------------------------------------------------------------------------------------------------
        // Cuarta Forma: la mas optimizada
         $personasRolPaciente = Persona::whereHas('user.roles', function($query){
            $query->where('name', 'paciente');
        })->with('user')->get();
        /*
        This will retrieve all 'Persona' records that have a related 'User' model with a role named 'secretaria' 
        directly from the database, without the need for the foreach loop.
        This way you are saving time and memory by not having to iterate over all the pacientes and check if they 
        have the role of secretaria.
        */

        return view('secretaria.pacientes.index', compact('personasRolPaciente'));

    }


    

    public function create()
    {
        return view('secretaria.pacientes.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:15', 'unique:users,username', 'alpha_dash'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
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

        $success = 'El paciente se creó con éxito';
         
        return view('secretaria.pacientes.creedenciales', compact('user', 'paciente', 'success'));
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
