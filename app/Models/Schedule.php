<?php

namespace App\Models;

use App\Models\Person;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'day',
        'active',
        'morning_start',
        'morning_end',
        'afternoon_start',
        'afternoon_end',
        'person_id',
    ];

// export this constants
    
    public const DIAS = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes'];
    public const H_INGRESO_MORNING = 9;
    public const H_SALIDA_MORNING = 12;
    public const H_INGRESO_TARDE = 16;
    public const H_SALIDA_TARDE = 18;


    // Relationship with Person
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

}
