<?php

namespace App\Models;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VitalSign extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'height',
        'weight',
        'body_mass_index',
        'temperature',
        'blood_pressure',
        'heart_rate',
        'respiratory_rate',
        'status',
        'updated_by',
        'created_by',
    ];


    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

}
