<?php

namespace App\Models;

use App\Models\Person;
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

    public function persons()
    {
        return $this->belongsToMany(Person::class)->withTimestamps();
    }

    // function to get the number of specialities
    public static function countSpecialities()
    {
        return Speciality::count();
    }
}
