<?php

namespace App\Models;

use App\Models\User;
use App\Models\Speciality;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cedula',
        'apellidos',
        'nombres',
        //'email',
        'telefono',
        'direccion',
        'ciudad',
        'fecha_nacimiento',
        'genero'
    ];

    public const GENEROS = ['Masculino', 'Femenino', 'Otro'];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
        // El metodo withDefault() es para que si no encuentra el usuario, no de error
    }

    // Relationship with Speciality
    public function specialities( )
    {
        return $this->belongsToMany(Speciality::class)->withTimestamps();
    }

    // Relationship with Appointment
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }


    // Function to get the full name of a Person
    public function getFullNameAttribute()
    {
        return "{$this->apellidos}, {$this->nombres}";
    }

    // Function to check if all attributes of a Person are null
    public function isComplete()
    {
        // $attributes = $this->getAttributes();
        // $attributes = array_filter($attributes, fn($value) => $value !== null);
        // return count($attributes) > 0;

        $attributes = $this->getFillable();

        foreach ($attributes as $attribute) {
            if ($this->$attribute === null) {
                return false;
            }
        }
            return true;
    }
    
    // create method to get the roles of the person
    public function getRolesAttribute()
    {
        return $this->user->roles;
    }
    
    // create method to get know if the person has specialities
    public function hasSpecialities()
    {
        return $this->specialities->isNotEmpty();
    }


}