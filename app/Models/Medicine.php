<?php

namespace App\Models;

use App\Models\Prescription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'presentation',
    ];

    public function prescriptions()
    {
        return $this->belongsToMany(Prescription::class)->withTimestamps()->withPivot('quantity', 'duration', 'observations');
    }
}
