<?php

namespace App\Models;

use App\Models\Appointment;
use App\Models\Prescription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MedicalExam extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type'
    ];

    public function prescriptions()
    {
        return $this->belongsToMany(Prescription::class)->withTimestamps()->withPivot('observations');
    }
}
