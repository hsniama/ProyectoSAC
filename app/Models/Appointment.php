<?php

namespace App\Models;

use App\Models\Persona;
use App\Models\Speciality;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'speciality_id',
        'scheduled_date',
        'scheduled_time',
        'notes'
    ];

    public function patient()
    {
        return $this->belongsTo(Persona::class, 'patient_id')->withDefault();
    }

    public function doctor()
    {
        return $this->belongsTo(Persona::class, 'doctor_id')->withDefault();
    }

    public function speciality()
    {
        return $this->belongsTo(Speciality::class)->withDefault();
    }

}
