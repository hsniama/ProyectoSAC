<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Person;
use App\Models\Medicine;
use App\Models\Diagnosis;
use App\Models\VitalSign;
use App\Models\Speciality;
use App\Models\MedicalExam;
use App\Models\Prescription;
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
        'notes',
        'status',
    ];

    public const MOTIVOS = [
        'Consulta/Cita Médica',
        'Revisión de Exámenes',
        'Otro'
    ];

    public const STATUS = [
        'Atendido',
        'Cancelada',
        'Pendiente'
    ];

    public function patient()
    {
        return $this->belongsTo(Person::class, 'patient_id')->withDefault();
    }

    public function doctor()
    {
        return $this->belongsTo(Person::class, 'doctor_id')->withDefault();
    }

    public function diagnosis()
    {
        return $this->hasOne(Diagnosis::class);
    }

    public function vitalSign()
    {
        return $this->hasOne(VitalSign::class);
    }

    public function prescription()
    {
        return $this->hasOne(Prescription::class);
    }

    // public function speciality()
    // {
    //     return $this->belongsTo(Speciality::class)->withDefault();
    // }

    // function to get the total number of appointments
    public static function countAppointments()
    {
        return Appointment::count();
    }

    public function getScheduledTimeAttribute($value)
    {
        return (new Carbon($value))->format('H:i');
    }
}
