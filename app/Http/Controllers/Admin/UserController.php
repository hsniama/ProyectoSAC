<?php

namespace App\Http\Controllers\Admin; //ojo que yo cambie esta, por que cree la carpeta de Admin

use App\Models\User;
use App\Models\Person;
use App\Models\Speciality;
use Carbon\Carbon; // yo agregue esta
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Arr; // yo agregue esta
use Illuminate\Http\Request; // yo agregue esta
use Yajra\DataTables\DataTables; // yo agregue esta
use Illuminate\Support\Facades\DB; // yo agregue esta
use Spatie\Permission\Models\Role; // yo agregue esta
use App\Http\Controllers\Controller; // yo agregue esta
use Illuminate\Support\Facades\Hash; // yo agregue esta

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /*
    Debo crear un constuctor para definir un middleware para permisos de usuario ya que en las rutas estoy con
    resource y no le puedo definir a cada una, entonces defino mi logica aqui.
    */

    public function __construct()
    {
        $this->middleware('can:user-list')->only('index');
        $this->middleware('can:user-create')->only('create', 'store');
        $this->middleware('can:user-edit')->only('edit', 'update');
        $this->middleware('can:user-delete')->only('destroy');
        $this->middleware('can:user-show')->only('show');
    }



    public function index(Request $request)
    {
        // $users = User::all(); Me da problemas de duplicidad de datos y n+1.

        // $users = User::with(['roles:name', 'person.specialities:name'])
        // ->select('id', 'username', 'email', 'created_at', 'updated_at')->get();

        // return view('admin.users.index', compact('users'));

        if ($request->ajax()) {
            
            $users = User::with(['roles:name', 'person.specialities:name'])
            ->select('id', 'username', 'email', 'created_at', 'updated_at')->get();


            return DataTables::of($users)
                ->addColumn('roles', function ($user) {
                        if ($user->getRoleNames() ){
                            foreach ($user->getRoleNames() as $rol){
                                if ($rol == 'admin' || $rol == 'super-admin')
                                    return '<span class="badge bg-danger mb-1">' . $rol . '</span> </br>';
                                elseif ($rol == 'gerente')
                                    return '<span class="badge bg-warning mb-1">' . $rol . '</span> </br>';
                                elseif ($rol == 'secretaria')
                                    return '<span class="badge bg-primary mb-1">' . $rol . '</span> </br>';
                                elseif ($rol == 'doctor')
                                    return '<span class="badge bg-success mb-1">' . $rol . '</span> </br>';
                                elseif ($rol == 'paciente')
                                    return '<span class="badge bg-cyan mb-1">' . $rol . '</span> </br>';
                                else
                                    return '<span class="badge bg-secondary mb-1">' . $rol . '</span> </br>';
                            }
                        }                                              
                })
                ->addColumn('actions', function ($user) {
                    $edit = '';
                    $delete = '';
                    $show = '';

                    if (auth()->user()->can('user-show')) {
                        $show = '<a href="' . route('admin.users.show', $user->id) . '" class="show btn btn-info btn-sm">
                                    <i class="fa fa-fw fa-eye"></i>
                                </a>';
                    }
                    if (auth()->user()->can('user-edit')) {
                        $edit = '<a href="' . route('admin.users.edit', $user->id) . '" class="edit btn btn-warning btn-sm">
                                    <i class="fa fa-fw fa-edit"></i>
                                </a>';
                    }
                    if (auth()->user()->can('user-delete')) {
                        $delete = '
                        <form action="' . route('admin.users.destroy', $user->id) . '" method="POST" class="d-inline eliminarUsuario">
                           <input type="hidden" name="_method" value="DELETE">
                           <input type="hidden" name="_token" value="' . csrf_token() . '">
                           <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></button>
                       </form>';
                    }

                    return $show . ' ' . $edit . ' ' . $delete;
                })
                ->addColumn('observaciones', function ($user) {
                    $observaciones = '<div class ="text-left">';
             
                        if (!$user->person){
                            $observaciones .= '
                                <p>No ha completado su perfil. 
                                    <a href="' . route("admin.persons.create.personrol", $user->id) .'" class="text-decoration-none">
                                        Completalo Aqui
                                    </a>
                                </p>
                            ';
                        }

                            if ($user->hasRole("doctor") && !$user->hasPersonAndSpeciality()){
                                $observaciones .= '
                                    <p>No tiene especialidades asignadas.</p>
                                ';
                            }

                            if ($user->hasRole("doctor") && $user->hasPersonAndSpeciality()) {
                                $observaciones .= '
                                    <p>Tiene asignado las siguientes especialidades: </p>
                                ';
                                foreach ($user->person->specialities as $especialidad){
                                    $observaciones .= '
                                        <span class="badge badge-primary"> '.$especialidad->name.' </span>
                                    ';
                                }
                            }

                        $observaciones .= '</div>';

                    return $observaciones;
                })
                ->rawColumns(['roles', 'actions', 'observaciones'])
                ->make(true);
        }

        return view('admin.users.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        // User::create($request->validated());
        $request->validated();

        if ($request['email_verified_at'] == 'Si') {
            $confirmado = Carbon::now();
            ;
        } else {
            $confirmado= null;
        }

        $user = User::create([
            'username' => $request['username'],
            'email' => $request['email'],
            'email_verified_at' => $confirmado,
            'password' => Hash::make($request['password']),
        ]);

        $user->assignRole($request->input('roles'));

        $person = Person::create([
            'user_id' => $user->id,
            'cedula' => $request['cedula'],
            'apellidos' => $request['apellidos'],
            'nombres' => $request['nombres'],
            'telefono' => $request['telefono'],
            'direccion' => $request['direccion'],
            'ciudad' => $request['ciudad'],
            'fecha_nacimiento' => $request['fecha_nacimiento'],
            'genero' => $request['genero']
        ]);

        // Attach the specialities to the person
        $person->specialities()->attach($request->input('specialities'));

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // Regla de negocio: Calcular la edad de la person.

        $edad =0;

        if($user->person){
            $birthday = $user->person->fecha_nacimiento;
            $edad = \Carbon\Carbon::parse($edad)->age;
        }
           
        return view('admin.users.show', compact('user', 'edad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();

        $userRole = $user->roles->pluck('name', 'id')->all();

        return view('admin.users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        // $user->update($request->validated());

        $request->validated();

        
        if ($request['password'] == null) {
            $user::where('id', $user->id)->update(['password' => $user->password]);
        } else {
            $user::where('id', $user->id)->update(['password' => Hash::make($request['password'])]);
        }
        
        $user->update($request->except('password'));
        
        DB::table('model_has_roles')->where('model_id', $user->id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuario eliminado exitosamente.');

        // return back()->with('delete', 'Usuario eliminado exitosamente.');
    }
}
