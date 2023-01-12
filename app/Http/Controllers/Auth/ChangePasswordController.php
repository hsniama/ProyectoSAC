<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller; // yo agregue esta


class ChangePasswordController extends Controller
{
    //create invoke function
    public function __invoke()
    {
        //return view('auth.passwords.change');
    }

    public function index()
    {
        return view('auth.passwords.change');
    }

    public function changePassword(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'current_password' => 'required',
            'new_password' => ['required','string','min:8', 'confirmed'],
        ]);

        // dd('hola');

        $user = User::find(auth()->user()->id);

        if (Hash::check($request->current_password, $user->password)) {

            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect()->back()->with('success', 'Contraseña cambiada exitosamente!');

        } else {
            return redirect()->back()->with('error', 'La contraseña actual no es correcta!');
        }
    }
    
}