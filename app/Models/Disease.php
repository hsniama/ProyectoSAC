<?php

namespace App\Models;

use App\Models\Diagnosis;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Disease extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id', 
        'name',
        'observaciones'
    ];

    public function diagnosis()
    {
        return $this->belongsToMany(Diagnosis::class)->withTimestamps()->withPivot('duration', 'status', 'probability', 'notes');
    }

    public function patient()
    {
        return $this->belongsToMany(Person::cass, 'patient_id')->withDefault();
    }
}
