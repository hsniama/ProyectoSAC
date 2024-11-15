<?php

namespace App\Http\Controllers\API;

use Validator;
use Carbon\Carbon;
use App\Models\Schedule;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AppointmentService;

class ScheduleController extends Controller
{

    protected $appointmentService;

    public function __construct(AppointmentService $appointmentService)
    {
        $this->appointmentService = $appointmentService;
    }

    public function getAvailableHours(Request $request)
    {
        $rules = [
            'scheduled_date' => 'required|date_format:Y-m-d',
            'doctor_id' => 'required|integer|exists:people,id'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }


        $date = $request->input('scheduled_date');


        $dateCarbon = new Carbon($date);
        $i = $dateCarbon->dayOfWeek;
        $day = ($i==0 ? 6 : $i-1);


        $doctorId = $request->input('doctor_id');

        $horario = Schedule::where('active', 1)
                            ->where('person_id', $doctorId)
                            ->where('day', $day)
                            ->first(['morning_start', 'morning_end', 'afternoon_start', 'afternoon_end']);



        if (!$horario) {
            // return response()->json(['error' => 'El médico no tiene horario disponible'], 404);
            return [];

        }

        $morningIntervals = $this->getAvailableIntervals($horario->morning_start, $horario->morning_end, $doctorId, $date);
        $afternoonIntervals = $this->getAvailableIntervals($horario->afternoon_start, $horario->afternoon_end, $doctorId, $date);

        $data = [];
        // $data = array_merge($morningIntervals, $afternoonIntervals);
        $data['morning'] = $morningIntervals;
        $data['afternoon'] = $afternoonIntervals;

        return response()->json($data, 200);

    }

    private function getAvailableIntervals($start, $end, $doctorId, $date)
    {

        //get current date and time
        $nowDate = new Carbon();
        $nowTime = $nowDate->format('H:i');


        $start = new Carbon($start);
        $end = new Carbon($end);

        $intervals = [];

        while ($start->lt($end)) {
            $interval = [];
            $interval['start'] = $start->format('H:i');

            $available = $this->appointmentService->isAvailableInterval($date, $doctorId, $start);

            $start->addMinutes(40);
            $interval['end'] = $start->format('H:i');

            if ($available) {
                if($date == $nowDate->format('Y-m-d') && $interval['start'] < $nowTime)
                    continue;
                else
                    $intervals[] = $interval;
            }
        }

        return $intervals;
    }

}
