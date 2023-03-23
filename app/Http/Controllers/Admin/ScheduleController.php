<?php

namespace App\Http\Controllers\Admin;

use App\Models\Person;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Http\Controllers\Controller; // yo agregue esta



class ScheduleController extends Controller
{


    public function __construct()
    {
        $this->middleware('can:horario-list')->only('index');
        $this->middleware('can:horario-create')->only('create', 'store');
        $this->middleware('can:horario-edit')->only('edit', 'update');
        $this->middleware('can:horario-delete')->only('destroy');
        $this->middleware('can:horario-show')->only('show');
    }


    public function index()
    {
        // select all except created_at and updated_at
        $schedules = Schedule::select('id', 'day', 'morning_start', 'morning_end', 'afternoon_start', 'afternoon_end', 'status', 'person_id')->get();
        
        return view('admin.schedules.index', compact('schedules'));
    }

}
