<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Person;
use App\Models\Speciality;
use App\Http\Requests\StorePersonRequest;
use App\Http\Requests\UpdatePersonRequest;
use App\Http\Controllers\Controller; // yo agregue esta


class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct(){
         $this->middleware('can:person-list')->only('index');
         $this->middleware('can:person-create')->only('create', 'store');
         $this->middleware('can:person-edit')->only('edit', 'update');
         $this->middleware('can:person-delete')->only('destroy');
         $this->middleware('can:person-show')->only('show');
    }


    public function index()
    {
        // $persons = Person::with('user')->get();
        $persons = Person::with(['user.roles', 'specialities'])->get();

        return view('admin.persons.index', compact('persons'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Necesito saber a que usuario le voy  a crear la person
        // $users = User::all(); Da problemas de duplicidad de datos y n+1.
        $users = User::with('person')->get();

        // Bring the specialities that have status active
        //$specialities = Speciality::where('status', 'Activo')->get();


        return view('admin.persons.create', compact('users'));
    }

    // Create method to create a doctor
    public function createSegunRol(User $user)
    {
        if ($user->hasRole('doctor')) {
            // Bring the specialities that have status active
            $specialities = Speciality::where('status', 'Activo')->get();

            return view('admin.persons.create-personrol', compact('user', 'specialities'));
            
        } else{
            return view('admin.persons.create-personrol', compact('user'));         
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePersonRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePersonRequest $request)
    {
        $person = Person::create($request->validated());

        // Attach the specialities to the person
        $person->specialities()->attach($request->specialities);
    

        return redirect()->route('admin.persons.index')->with('success', 'La person se creó con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        // Regla de negocio: Calcular la edad de la person.
        $birthday = $person->fecha_nacimiento;
        $edad = \Carbon\Carbon::parse($birthday)->age;


        return view('admin.persons.show', compact('person', 'edad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        $users = User::all();

        $specialities = Speciality::where('status', 'Activo')->get();


        
        return view('admin.persons.edit', compact('users', 'person', 'specialities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePersonRequest  $request
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePersonRequest $request, Person $person)
    {
        $person->update($request->validated());

        // Attach the specialities to the person
        $person->specialities()->sync($request->specialities);

        return redirect()->route('admin.persons.index')->with('success', 'La person se actualizó con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        $person->delete();

        
        return redirect()->route('admin.persons.index')->with('success', 'La person se eliminó con éxito');
    }
}
