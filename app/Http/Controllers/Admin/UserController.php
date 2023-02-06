<?php

namespace App\Http\Controllers\Admin; //ojo que yo cambie esta, por que cree la carpeta de Admin

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Controllers\Controller; // yo agregue esta
use Illuminate\Support\Facades\DB; // yo agregue esta
use Illuminate\Support\Facades\Hash; // yo agregue esta
use Spatie\Permission\Models\Role; // yo agregue esta
use Illuminate\Support\Arr; // yo agregue esta
use Carbon\Carbon; // yo agregue esta

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

     public function __construct(){
         $this->middleware('can:user-list')->only('index');
         $this->middleware('can:user-create')->only('create', 'store');
         $this->middleware('can:user-edit')->only('edit', 'update');
         $this->middleware('can:user-delete')->only('destroy');
         $this->middleware('can:user-show')->only('show');
    }



    public function index()
    {
        // $users = User::all(); Me da problemas de duplicidad de datos y n+1.

        // $users = User::with('roles')->get();
        // $users = User::with(['roles', 'person'])->get();

        $users = User::with(['roles', 'person.specialities'])->get();

        return view('admin.users.index', compact('users'));
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
            $confirmado = Carbon::now();;
        }else{
            $confirmado= null;
        }

        $user = User::create([
            'username' => $request['username'],
            'email' => $request['email'],
            'email_verified_at' => $confirmado,
            'password' => Hash::make($request['password']),
        ]);

        $user->assignRole($request->input('roles'));

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
        //
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

        
        if($request['password'] == null){        
            $user::where('id', $user->id)->update(['password' => $user->password]);
        }else {
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
