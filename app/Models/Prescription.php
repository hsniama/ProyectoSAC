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
        'recommendations',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class)->withDefault();
    }

    public function medicalExams()
    {
        return $this->belongsToMany(MedicalExam::class)->withTimestamps()->withPivot('observations');
    }

    public function medicines()
    {
        return $this->belongsToMany(Medicine::class)->withTimestamps()->withPivot('quantity', 'days', 'observations');
    }
}
