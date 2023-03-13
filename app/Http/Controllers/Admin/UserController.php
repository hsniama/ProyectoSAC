<?php

namespace App\Http\Controllers\Admin; //ojo que yo cambie esta, por que cree la carpeta de Admin

use Carbon\Carbon;
use App\Models\User;
use App\Models\Person;
use App\Models\Schedule;
use App\Models\Speciality;
use Illuminate\Support\Str;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateScheduleRequest;
use Illuminate\Support\Arr; // yo agregue esta
use Illuminate\Http\Request; // yo agregue esta
use Yajra\DataTables\DataTables; // yo agregue esta
use Illuminate\Support\Facades\DB; // yo agregue esta
use Spatie\Permission\Models\Role; // yo agregue esta

use App\Http\Controllers\Controller; // yo agregue esta
use Illuminate\Support\Facades\Hash; // yo agregue esta







class UserController extends Controller
{

    private $dias = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes'];

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
            ->select('id', 'username', 'email', 'created_at', 'updated_at', 'email_verified_at', 'status')->get();


            return DataTables::of($users)
                ->addColumn('roles', function ($user) {
                    $roles = '';
                        if ($user->getRoleNames() ){
                            foreach ($user->getRoleNames() as $rol){
                                if ($rol == 'admin' || $rol == 'super-admin')
                                    $roles .= '<span class="badge bg-danger mb-1">' . $rol . '</span> </br>';
                                elseif ($rol == 'gerente')
                                    $roles .=  '<span class="badge bg-warning mb-1">' . $rol . '</span> </br>';
                                elseif ($rol == 'secretaria')
                                    $roles .=  '<span class="badge bg-primary mb-1">' . $rol . '</span> </br>';
                                elseif ($rol == 'doctor')
                                    $roles .=  '<span class="badge bg-success mb-1">' . $rol . '</span> </br>';
                                elseif ($rol == 'paciente')
                                    $roles .=  '<span class="badge bg-cyan mb-1">' . $rol . '</span> </br>';
                                else
                                    $roles .=  '<span class="badge bg-secondary mb-1">' . $rol . '</span> </br>';
                            }
                        }
                        
                    return $roles;
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

                        if (empty($user->email_verified_at) ) {
                            $observaciones .= '
                                <p>El usuario no ha verificado su correo electronico.</p>
                            ';
                        }

                        if ($user->status === 'Inactivo'){
                            $observaciones .= '
                                <p>El usuario esta <span class = "text-danger font-weight-bold">deshabilitado/inactivo/baneado</span>  del sistema.</p>
                            ';
                        }

                        $observaciones .= '</div>';

                    return $observaciones;
                })
                ->rawColumns(['roles', 'actions', 'observaciones'])
                ->make(true);
        }

        return view('admin.users.index');

    }


    public function create()
    {
        $roles = Role::all();

        return view('admin.users.create', compact('roles'));
    }


    public function store(StoreUserRequest $request)
    {
        // User::create($request->validated());
        $request->validated();


        if ($request['email_verified_at'] == 'Si') {
            $confirmado = Carbon::now();
        } else {
            $confirmado= null;
        }

        $user = User::create([
            'username' => $request['username'],
            'email' => $request['email'],
            'email_verified_at' => $confirmado,
            'password' => Hash::make($request['password']),
            'status' => $request->input('status'),
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
            'genero' => $request['genero'],
        ]);


        //get the roles of the user
        $userRoles = $user->getRoleNames();

        foreach ($userRoles as $rol) {
            if ($rol == 'doctor') {
                // Attach the specialities to the person
                $person->specialities()->attach($request->input('specialities'));

                // Agrego por defecto el horario laboral del medico de L-V de 9 a 12 y de 14 a 16.
                for ($i=0; $i <5 ; $i++) { 
                    $scheduleNew =  Schedule::create([
                        'person_id' => $person->id,
                        'day' => $i,
                        'active' => 1,
                        'morning_start' => strval(Schedule::H_INGRESO_MORNING).':00:00',
                        'morning_end' => strval(Schedule::H_SALIDA_MORNING).':00:00',
                        'afternoon_start' => strval(Schedule::H_INGRESO_TARDE).':00:00',
                        'afternoon_end' => strval(Schedule::H_SALIDA_TARDE).':00:00',
                    ]);

                }
            }
        }


        return redirect()->route('admin.users.index')
            ->with('success', 'Usuario creado exitosamente.');
    }


    public function show(User $user)
    {
        // Regla de negocio: Calcular la edad de la person.

        $edad =0;

        if($user->person){
            $edad = $user->person->getAgeAttribute();
        }
           
        return view('admin.users.show', compact('user', 'edad'));
    }


    public function edit(User $user)
    {
        $specialities = Speciality::where('status', 'Activo')->get();
        $roles = Role::all();

        $userRole = $user->roles->pluck('name', 'id')->all();
        $person = $user->person;

        // bring the schedules of the person
        $schedules = $user->person->schedules;


        $dias = $this->dias;

        foreach ($dias as $key => $value) {
            if (!$schedules->contains('day', $key)) {
                $schedules->push(new Schedule([
                    'day' => $key,
                    'morning_start' => strval(Schedule::H_INGRESO_MORNING).':00:00',
                    'morning_end' => strval(Schedule::H_SALIDA_MORNING).':00:00',
                    'afternoon_start' => strval(Schedule::H_INGRESO_TARDE).':00:00',
                    'afternoon_end' => strval(Schedule::H_SALIDA_TARDE).':00:00',
                    'active' => 0,
                    'person_id' => $person->id,
                ]));
            }
        }

        $schedules->map(function ($schedule) {
            $schedule->morning_start = (new Carbon($schedule->morning_start))->format('g:i A');
            $schedule->morning_end = (new Carbon($schedule->morning_end))->format('g:i A');
            $schedule->afternoon_start = (new Carbon($schedule->afternoon_start))->format('H:i A');
            $schedule->afternoon_end = (new Carbon($schedule->afternoon_end))->format('H:i A');
            // return $schedule;
        });

        // dd($schedules->toArray());

        return view('admin.users.edit', compact('user', 'roles', 'userRole', 'person', 'specialities', 'schedules'));
    }


    public function update(UpdateUserRequest $request, User $user)
    {
        // $user->update($request->validated());

        $request->validated();

        
        if ($request['password'] == null) {
            $user::where('id', $user->id)->update(['password' => $user->password]);
        } else {
            $user::where('id', $user->id)->update(['password' => Hash::make($request['password'])]);
        }
        
        $user->update($request->only('username', 'email', 'status'));
        
        DB::table('model_has_roles')->where('model_id', $user->id)->delete();

        $user->assignRole($request->input('rolesEdit'));


        // Update the person
        $person = Person::where('user_id', $user->id)->first(); 

        // $person->update($request->except('password', 'rolesEdit', 'username', 'email', 'specialitiesEdit'));
        $person->update($request->only('cedula', 'nombres', 'apellidos', 'telefono', 'direccion', 'ciudad', 'fecha_nacimiento', 'genero'));


        //get the roles of the user
        $userRoles = $user->getRoleNames();

        foreach ($userRoles as $rol) {
            if ($rol !== 'doctor') {
                $person->specialities()->detach();
            }
        }


        // Sync the specialities to the person
        $person->specialities()->sync($request->input('specialitiesEdit'));


        //------------------------------------------------------------------------------------

        //Update the schedule of the person:
        // $schedules = $person->schedules;


        $active = $request->input('active') ? : [];
        $morning_start = $request->input('morning_start');
        $morning_end = $request->input('morning_end');
        $afternoon_start = $request->input('afternoon_start');
        $afternoon_end = $request->input('afternoon_end');

        // $requestSchedule = [
        //     'active' => $active,
        //     'morning_start' => $morning_start,
        //     'morning_end' => $morning_end,
        //     'afternoon_start' => $afternoon_start,
        //     'afternoon_end' => $afternoon_end,
        // ];


        // dd($requestSchedule);


        $errorsSchedule = [];

        for($i =0; $i<5; ++$i){

            if ($morning_start[$i] > $morning_end[$i]) {
                $errorsSchedule[] = 'La hora de inicio de la mañana del dia '. $this->dias[$i] .' no puede ser mayor a la hora de finalización.';
            }

            if ($afternoon_start[$i] > $afternoon_end[$i]) {
                $errorsSchedule[] = 'La hora de inicio de la tarde del dia '. $this->dias[$i] .' no puede ser mayor a la hora de finalización.';
            }

            Schedule::updateOrCreate([
                'day' => $i,           
                'person_id' => $person->id,   
            ], [        
                'active' => in_array($i, $active),
                'morning_start' => $morning_start[$i],
                'morning_end' => $morning_end[$i],
                'afternoon_start' => $afternoon_start[$i],
                'afternoon_end' => $afternoon_end[$i],
            ]);
        }

        // dd($errorsSchedule);

        if (count($errorsSchedule) > 0) {
            return redirect()->route('admin.users.edit', $user->id)->with('errorsSchedule', $errorsSchedule);
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuario actualizado exitosamente.');
    }


    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuario eliminado exitosamente.');

        // return back()->with('delete', 'Usuario eliminado exitosamente.');
    }
}
