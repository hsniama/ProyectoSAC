<?php

namespace App\Models;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Survey extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'doctor_qualification',
        'satisfaction',
        'recommendation',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

}
