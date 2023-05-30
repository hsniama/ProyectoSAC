<?php

namespace App\Models;

use App\Models\Diagnosis;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Symptom extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
    ];

    public function diagnosis()
    {
        return $this->belongsToMany(Diagnosis::class)->withTimestamps();
    }
}
