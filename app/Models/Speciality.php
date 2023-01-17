<?php

namespace App\Models;

use App\Models\Persona;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Speciality extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'created_by',
        'updated_by',
    ];

    public const ESTADOS = ['Activo', 'Inactivo'];

    public function personas()
    {
        return $this->belongsToMany(Persona::class)->withTimestamps();
    }
}
