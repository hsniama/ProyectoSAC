<?php

namespace App\Models;

use App\Models\Medicine;
use App\Models\Appointment;
use App\Models\MedicalExam;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'recommendations',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class)->withDefault();
    }

    public function medicalExams()
    {
        return $this->belongsToMany(MedicalExam::class)->withPivot('observations')->withTimestamps();
    }

    public function medicines()
    {
        return $this->belongsToMany(Medicine::class)->withPivot('quantity', 'duration', 'observations')->withTimestamps();
    }
}
