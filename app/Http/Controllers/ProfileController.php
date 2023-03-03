<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\User;
use App\Http\Requests\StorePersonRequest;
use App\Http\Requests\UpdatePersonRequest;
use App\Http\Controllers\Controller; // yo agregue esta

class ProfileController extends Controller
{
    public function __invoke()
    {
        //return view('profile.create');
    }

    public function __construct()
    {
        $this->middleware('can:profile-create')->only('create', 'store');
        $this->middleware('can:profile-edit')->only('edit', 'update');
    }

    public function create()
    {
        // Necesito saber a que usuario le voy  a crear la person
        $users = User::all();

        return view('profile.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'cedula' => ['required', 'numeric', 'unique:people'],
            'apellidos' => ['required', 'string', 'max:255', 'min:3', 'string'],
            'nombres' => ['required', 'string', 'max:255', 'min:3', 'string'],
            //'email' => ['required', 'email', 'max:255', 'min:3', 'unique:people'],
            'telefono' => ['required', 'numeric'],
            'direccion' => ['required', 'max:255', 'min:3', 'string'],
            'ciudad' => ['required', 'max:255', 'min:3', 'string', 'string'],
            'fecha_nacimiento' => ['required', 'date'],
            'genero' => ['required', 'string']
        ]);

        Person::create($request->all());

        return redirect()->route('home')->with('success', 'Perfil completado con éxito');
    }

    public function edit($id)
    {
        $person = Person::findOrFail($id);
        return view('profile.edit', compact('person'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cedula' => ['required', 'numeric', 'unique:people,cedula,'.$id],
            'apellidos' => ['required', 'string', 'max:255', 'min:3', 'string'],
            'nombres' => ['required', 'string', 'max:255', 'min:3', 'string'],
            //'email' => ['required', 'email', 'max:255', 'min:3', 'unique:people,email,'.$id],
            'telefono' => ['required', 'numeric'],
            'direccion' => ['required', 'max:255', 'min:3', 'string'],
            'ciudad' => ['required', 'max:255', 'min:3', 'string', 'string'],
            'fecha_nacimiento' => ['required', 'date'],
            'genero' => ['required', 'string']
        ]);

        $person = Person::findOrFail($id);

        $person->update($request->all());

        return redirect()->route('home')->with('success', 'Perfil actualizado con éxito');
    }
}
