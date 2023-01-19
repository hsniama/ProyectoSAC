<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Persona;
use App\Models\Speciality;
use App\Http\Requests\StorePersonaRequest;
use App\Http\Requests\UpdatePersonaRequest;
use App\Http\Controllers\Controller; // yo agregue esta


class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct(){
         $this->middleware('can:persona-list')->only('index');
         $this->middleware('can:persona-create')->only('create', 'store');
         $this->middleware('can:persona-edit')->only('edit', 'update');
         $this->middleware('can:persona-delete')->only('destroy');
         $this->middleware('can:persona-show')->only('show');
    }


    public function index()
    {
        // $personas = Persona::with('user')->get();
        $personas = Persona::with(['user.roles', 'specialities'])->get();

        return view('admin.personas.index', compact('personas'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Necesito saber a que usuario le voy  a crear la persona
        // $users = User::all(); Da problemas de duplicidad de datos y n+1.
        $users = User::with('persona')->get();

        // Bring the specialities that have status active
        //$specialities = Speciality::where('status', 'Activo')->get();


        return view('admin.personas.create', compact('users'));
    }

    // Create method to create a doctor
    public function createSegunRol(User $user)
    {
        if ($user->hasRole('doctor')) {
            // Bring the specialities that have status active
            $specialities = Speciality::where('status', 'Activo')->get();

            return view('admin.personas.create-personarol', compact('user', 'specialities'));
            
        } else{
            return view('admin.personas.create-personarol', compact('user'));         
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePersonaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePersonaRequest $request)
    {
        $persona = Persona::create($request->validated());

        // Attach the specialities to the persona
        $persona->specialities()->attach($request->specialities);
    

        return redirect()->route('admin.personas.index')->with('success', 'La persona se creó con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show(Persona $persona)
    {
        // Regla de negocio: Calcular la edad de la persona.
        $birthday = $persona->fecha_nacimiento;
        $edad = \Carbon\Carbon::parse($birthday)->age;


        return view('admin.personas.show', compact('persona', 'edad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function edit(Persona $persona)
    {
        $users = User::all();

        $specialities = Speciality::where('status', 'Activo')->get();


        
        return view('admin.personas.edit', compact('users', 'persona', 'specialities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePersonaRequest  $request
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePersonaRequest $request, Persona $persona)
    {
        $persona->update($request->validated());

        // Attach the specialities to the persona
        $persona->specialities()->sync($request->specialities);

        return redirect()->route('admin.personas.index')->with('success', 'La persona se actualizó con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persona $persona)
    {
        $persona->delete();

        
        return redirect()->route('admin.personas.index')->with('success', 'La persona se eliminó con éxito');
    }
}
