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
use App\Services\UserService; // yo agregue esta


class UserController extends Controller
{

    private $dias = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes'];

    protected $userService;

    /*
    Debo crear un constuctor para definir un middleware para permisos de usuario ya que en las rutas estoy con
    resource y no le puedo definir a cada una, entonces defino mi logica aqui.
    */

    public function __construct(UserService $userService)
    {
        $this->middleware('can:user-list')->only('index');
        $this->middleware('can:user-create')->only('create', 'store');
        $this->middleware('can:user-edit')->only('edit', 'update');
        $this->middleware('can:user-delete')->only('destroy');
        $this->middleware('can:user-show')->only('show');

        $this->userService = $userService;
    }



    public function index(Request $request)
    {

        if ($request->ajax()) {      

            $users = User::with(['roles:name', 'person.specialities:name'])
                    ->select('id', 'username', 'email', 'created_at', 'updated_at', 'email_verified_at', 'status')->get();


            return DataTables::of($users)
                ->addColumn('roles', function ($user) {
                    return $this->userService->rolesColumn($user);
                })
                ->addColumn('actions', function ($user) {
                    return $this->userService->actionsColumn($user);
                })
                ->addColumn('observaciones', function ($user) {
                    return $this->userService->observationsColumn($user);
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
        $user = $this->userService->createUser($request->validated());

        $person = Person::where('user_id', $user->id)->first();


        //get the roles of the user
        $userRoles = $user->getRoleNames();

        foreach ($userRoles as $rol) {
            if ($rol == 'doctor') {
                // Attach the specialities to the person
                $person->specialities()->attach($request->input('specialities'));

                // Agrego por defecto el horario laboral del medico de L-V de 9 a 12 y de 16 a 18.
                for ($i=0; $i <5 ; $i++) { 
                    $scheduleNew =  Schedule::create([
                        'person_id' => $person->id,
                        'day' => $i,
                        'active' => 1,
                        'morning_start' => strval(Schedule::H_INGRESO_MORNING).':09:00',
                        'morning_end' => strval(Schedule::H_SALIDA_MORNING).':12:00',
                        'afternoon_start' => strval(Schedule::H_INGRESO_TARDE).':16:00',
                        'afternoon_end' => strval(Schedule::H_SALIDA_TARDE).':18:00',
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
        $roles = Role::all();
        $specialities = Speciality::where('status', 'Activo')->get();


        // bring the schedules of the person if it is a doctor
        $schedules = [];
        $userRole = $user->roles->pluck('name', 'id')->all();
        $person = $user->person;
        
        foreach ($userRole as $rol) {
            if ($rol == 'doctor') {
                $schedules = $this->userService->mapSchedules($user->person->schedules, $person, $this->dias);
            }
        }
        

        return view('admin.users.edit', compact('user', 'roles', 'specialities', 'schedules'));
    }


    public function update(UpdateUserRequest $request, User $user)
    {
        // $user->update($request->validated());

        $person = $this->userService->updateUser($request, $user);

        //------------------------------------------------------------------------------------
        //Update the schedule of the person if it is a doctor:
        // $schedules = $person->schedules;

        if($user->hasRole('doctor')){

            $errorsSchedule = $this->userService->updateCreateSchedule($request, $person, $this->dias);

            if (count($errorsSchedule) > 0) {
                return redirect()->route('admin.users.edit', $user->id)->with('errorsSchedule', $errorsSchedule);
            }
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
