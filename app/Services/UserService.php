<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Person;
use App\Models\Schedule;
use App\Models\Speciality;
use Illuminate\Support\Str;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateScheduleRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr; // yo agregue esta
use Illuminate\Http\Request; // yo agregue esta
use App\Services\UserService; // yo agregue esta
use Yajra\DataTables\DataTables; // yo agregue esta
use Illuminate\Support\Facades\DB; // yo agregue esta
use Spatie\Permission\Models\Role; // yo agregue esta
use App\Http\Controllers\Controller; // yo agregue esta
use Illuminate\Support\Facades\Hash; // yo agregue esta


class UserService
{

    // Methods used in the index method of the UserController

    public function rolesColumn(User $user) : string
    {
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
    }

    public function actionsColumn(User $user) : string
    {
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
    }

    public function observationsColumn(User $user) : string 
    {
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
    }


    //---------------------------------------------------------------------------------------------------
    public function createUser(Request $request) : User  
    {
        // $request->validated();

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

        return $user;
    }

    public function mapSchedules(Collection $schedules, Person $person, Array $dias) : Collection
    {

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

        return $schedules;
    }

    public function updateUser(Request $request, User $user) : Person
    {
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

        return $person;
    }

    public function updateCreateSchedule(Request $request, Person $person, Array $dias) : Array
    {
            $active = $request->input('active') ? : [];
            $morning_start = $request->input('morning_start') ? : null;
            $morning_end = $request->input('morning_end') ? : null;
            $afternoon_start = $request->input('afternoon_start') ? : null;
            $afternoon_end = $request->input('afternoon_end') ? : null;

            // $requestSchedule = [
            //     'active' => $active,
            //     'morning_start' => $morning_start,
            //     'morning_end' => $morning_end,
            //     'afternoon_start' => $afternoon_start,
            //     'afternoon_end' => $afternoon_end,
            // ];

            // dd($requestSchedule);

            if($morning_start == null || $morning_end == null || $afternoon_start == null || $afternoon_end == null){
                return redirect()->route('admin.users.index')
                ->with('error', 'Debe completar todos los horarios de atención del médico.');
            }


            $errorsSchedule = [];

            for($i =0; $i<5; ++$i){

                if ($morning_start[$i] > $morning_end[$i]) {
                    $errorsSchedule[] = 'La hora de inicio de la mañana del dia '. $dias[$i] .' no puede ser mayor a la hora de finalización.';
                }

                if ($afternoon_start[$i] > $afternoon_end[$i]) {
                    $errorsSchedule[] = 'La hora de inicio de la tarde del dia '. $dias[$i] .' no puede ser mayor a la hora de finalización.';
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

            return $errorsSchedule;

    }

}

?>