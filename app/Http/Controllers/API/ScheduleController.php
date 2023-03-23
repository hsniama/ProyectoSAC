<?php

namespace App\Http\Controllers\API;

use Validator;
use Carbon\Carbon;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{

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
            return response()->json(['error' => 'El médico no tiene horario disponible'], 404);
        }

        $morningIntervals = $this->getAvailableIntervals($horario->morning_start, $horario->morning_end);
        $afternoonIntervals = $this->getAvailableIntervals($horario->afternoon_start, $horario->afternoon_end);

        $data = [];
        $data['morning'] = $morningIntervals;
        $data['afternoon'] = $afternoonIntervals;

        return response()->json($data, 200);

    }

    private function getAvailableIntervals($start, $end)
    {
        $start = new Carbon($start);
        $end = new Carbon($end);

        $intervals = [];

        while ($start->lt($end)) {
            $interval = [];
            $interval['start'] = $start->format('H:i:s');
            $start->addMinutes(30);
            $interval['end'] = $start->format('H:i:s');
            $intervals[] = $interval;
        }

        return $intervals;
    }


    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        //
    }
}
