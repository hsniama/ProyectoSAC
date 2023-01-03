<?php

namespace App\Http\Controllers\Admin; //ojo que yo cambie esta, por que cree la carpeta de Admin

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Controllers\Controller; // yo agregue esta
use Illuminate\Support\Facades\DB; // yo agregue esta
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

     public function __construct(){
        //  $this->middleware('can:admin.users.index')->only('index');
        //  $this->middleware('can:admin.users.create')->only('create', 'store');
        //  $this->middleware('can:admin.users.edit')->only('edit', 'update');
        //  $this->middleware('can:admin.users.destroy')->only('destroy');
        //  $this->middleware('can:admin.users.show')->only('show');
     }


    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.users.create');
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

        User::create([
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

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
        return view('admin.users.edit', compact('user'));
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
        $user->update($request->validated());

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
