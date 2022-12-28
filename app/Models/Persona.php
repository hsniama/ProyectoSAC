<?php

namespace App\Models;

use App\Models\User;
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

}
