<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\User;
use App\Http\Requests\StorePersonaRequest;
use App\Http\Requests\UpdatePersonaRequest;
use App\Http\Controllers\Controller; // yo agregue esta

class PerfilController extends Controller
{
    public function __invoke()
    {
        //return view('perfil.create');
    }

     public function __construct(){
         $this->middleware('can:perfil-create')->only('create', 'store');
         $this->middleware('can:perfil-edit')->only('edit', 'update');
    }

    public function create()
    {
        // Necesito saber a que usuario le voy  a crear la persona
        $users = User::all();

        return view('perfil.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'cedula' => ['required', 'numeric', 'unique:personas'],
            'apellidos' => ['required', 'string', 'max:255', 'min:3', 'string'],
            'nombres' => ['required', 'string', 'max:255', 'min:3', 'string'],
            //'email' => ['required', 'email', 'max:255', 'min:3', 'unique:personas'],
            'telefono' => ['required', 'numeric'],
            'direccion' => ['required', 'max:255', 'min:3', 'string'],
            'ciudad' => ['required', 'max:255', 'min:3', 'string', 'string'],
            'fecha_nacimiento' => ['required', 'date'],
            'genero' => ['required', 'string']
        ]);

        Persona::create($request->all());

        return redirect()->route('home')->with('success', 'Perfil completado con éxito');
    }

    public function edit($id)
    {
        $persona = Persona::findOrFail($id);
        return view('perfil.edit', compact('persona'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cedula' => ['required', 'numeric', 'unique:personas,cedula,'.$id],
            'apellidos' => ['required', 'string', 'max:255', 'min:3', 'string'],
            'nombres' => ['required', 'string', 'max:255', 'min:3', 'string'],
            //'email' => ['required', 'email', 'max:255', 'min:3', 'unique:personas,email,'.$id],
            'telefono' => ['required', 'numeric'],
            'direccion' => ['required', 'max:255', 'min:3', 'string'],
            'ciudad' => ['required', 'max:255', 'min:3', 'string', 'string'],
            'fecha_nacimiento' => ['required', 'date'],
            'genero' => ['required', 'string']
        ]);

        $persona = Persona::findOrFail($id);

        $persona->update($request->all());

        return redirect()->route('home')->with('success', 'Perfil actualizado con éxito');
    }

}
