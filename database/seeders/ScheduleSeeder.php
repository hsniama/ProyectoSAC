<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Schedule;
use \App\Models\User;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create 21 schedules of 21 existing doctors
        Schedule::factory(21)->create([
            'morning_start' => '09:00:00',
            'morning_end' => '12:00:00',
            'afternoon_start' => '16:00:00',
            'afternoon_end' => '18:00:00',
        ]);
    }
}
