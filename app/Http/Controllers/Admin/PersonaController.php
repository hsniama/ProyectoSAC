<?php

namespace App\Http\Controllers\Admin;

use App\Models\Persona;
use App\Models\User;
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
    public function index()
    {
        $personas = Persona::with('user')->get();

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
        $users = User::all();

        return view('admin.personas.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePersonaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePersonaRequest $request)
    {
        Persona::create($request->validated());

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
        return view('admin.personas.show', compact('persona'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function edit(Persona $persona)
    {
        // Necesito saber a que usuario le voy  a crear la persona
        $users = User::all();

        return view('admin.personas.edit', compact('users', 'persona'));
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
