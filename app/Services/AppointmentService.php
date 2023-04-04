<?php
namespace App\Services;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Person;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentService 
{

    public function isAvailableInterval($date, $doctorId, Carbon $start) : bool
    {
        $exists = Appointment::where('doctor_id', $doctorId)
                                ->where('scheduled_date', $date)
                                ->where('scheduled_time', $start->format('H:i:s'))
                                ->where('status', 'Pendiente')
                                ->exists();
        
        return !$exists;
    }
}

?>