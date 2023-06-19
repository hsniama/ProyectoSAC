<?php

namespace App\Models;

use App\Models\Disease;
use App\Models\Symptom;
use App\Models\Appointment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Diagnosis extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'allergies',
        'current_medication',
        'drug_use',
        'alcohol_use',
        'smoking_use',
        'family_background',
        'surgical_history',
        'reason_for_consultation',
        'conclusions',
    ];



    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function symptoms()
    {
        return $this->belongsToMany(Symptom::class)->withPivot('duration', 'notes')->withTimestamps();
    }

    public function diseases()
    {
        return $this->belongsToMany(Disease::class)->withPivot('duration', 'status', 'probability', 'notes')->withTimestamps();
    }

    // METODOS
    //get disease name
    public function getDiseasesName()
    {
        return $this->diseases()->pluck('name');
    }

    //get the amount of each unique diseas:
    public function getDiseasesCount()
    {
        return $this->diseases()->countBy('name');
    }


    // public function addSymptom($symptom)
    // {
    //     $this->symptoms()->attach($symptom);
    // }

    // public function removeSymptom($symptom)
    // {
    //     $this->symptoms()->detach($symptom);
    // }

    // public function removeAllSymptoms()
    // {
    //     $this->symptoms()->detach();
    // }

    // public function getSymptoms()
    // {
    //     return $this->symptoms()->get();
    // }


    // public function getSymptomsId()
    // {
    //     return $this->symptoms()->pluck('symptom_id');
    // }

    // public function getSymptomsName()
    // {
    //     return $this->symptoms()->pluck('name');
    // }



}
