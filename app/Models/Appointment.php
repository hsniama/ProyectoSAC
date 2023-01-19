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


    // Get the amount of appointments per speciality:
    public function scopeSpecialityCount($query)
    {
        return $query->selectRaw('speciality_id, count(*) as total')->with('speciality')
            ->groupBy('speciality_id');
    }

    //Get the amount of appointments per Doctor:
    public function scopeDoctorCount($query)
    {
        return $query->selectRaw('doctor_id, count(*) as total')->with('doctor')
            ->groupBy('doctor_id');
    }

    //Get the amount of appointments per month:
    // public function scopeMonthCount($query)
    // {
    //     return $query->selectRaw('MONTH(scheduled_date) as month, count(*) as total')
    //         ->groupBy('month');
    // }

    //Get the amount of appointments per year:
    public function scopeYearCount($query)
    {
        return $query->selectRaw('YEAR(scheduled_date) as year, count(*) as total')
            ->groupBy('year');
    }
    


}
