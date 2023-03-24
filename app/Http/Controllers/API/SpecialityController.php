<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Speciality;
use Illuminate\Http\Request;

class SpecialityController extends Controller
{

    public function getActiveDoctors(Speciality $speciality)
    {

        $doctors = $speciality->persons()->whereHas('user', function($query){
            $query->where('status', 'Activo', 'and')->whereHas('roles', function($query){
                $query->where('name', 'doctor');
            });
        })->select('people.id', 'people.nombres', 'people.apellidos')->get();
        
        return response()->json($doctors);
       
    }

    public function specialities()
    {
        return Speciality::all();
    }

}
