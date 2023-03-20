<?php

namespace App\Services;

use App\Models\User;
use App\Models\Person;
use Illuminate\Http\Request;

class PacientService
{

    public function createPacient(Request $request) : User
    {

        $password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; //password

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' =>$password, //password,
        ])->assignRole('paciente');

        $paciente = Person::create([
            'user_id' => $user->id,
            'cedula' => $request->cedula,
            'apellidos' => $request->apellidos,
            'nombres' => $request->nombres,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'ciudad' => $request->ciudad,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'genero' => $request->genero,
        ]);

        return $user;
    }




}

?>