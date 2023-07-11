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

    public function edit($username)
    {
        // El ID de la persona es el mismo que el ID del usuario.
        // Find the $id of the username trough the username
        $user = User::where('username', $username)->select('id', 'username')->first();

        // La persona.
        // $person = Person::findOrFail($user->id);
        $person = Person::find($user->id);

        // La edad.
        $edad = $person->getAgeAttribute();

        return view('profile.edit', compact('person', 'edad'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            //'cedula' => ['required', 'numeric', 'unique:people,cedula,'.$id],
            //'apellidos' => ['required', 'string', 'max:255', 'min:3', 'string'],
            //'nombres' => ['required', 'string', 'max:255', 'min:3', 'string'],
            'email' => ['required', 'email', 'max:255', 'min:3', 'unique:users,email,'.$id],
            // 'email' => ['required', 'email', 'max:255', 'min:3', Rule::unique('users')->ignore($id)],
            'telefono' => ['required', 'numeric'],
            'direccion' => ['required', 'max:255', 'min:3', 'string'],
            'ciudad' => ['required', 'max:255', 'min:3', 'string'],
            'fecha_nacimiento' => ['required', 'date'],
            'genero' => ['required', 'string']
        ]);
  
        $person = Person::findOrFail($id);

        $person->update($request->except('email'));

        $user = User::findOrFail($person->user_id);
        //update only the email of the user
        $user->email = $request->input('email');
        $user->save();
        // $user->update($request->input('email'));

        return redirect()->route('home')->with('success', 'Perfil actualizado con éxito');
    }
}
