<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Persona extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cedula',
        'apellidos',
        'nombres',
        'email',
        'telefono',
        'direccion',
        'ciudad',
        'fecha_nacimiento',
        'genero'
    ];

    public const GENEROS = ['Masculino', 'Femenino', 'Otro'];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
        // El metodo withDefault() es para que si no encuentra el usuario, no de error
    }

    // Function to check if all attributes of a Persona are null
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
    
    

}
