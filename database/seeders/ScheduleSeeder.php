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
        // create 10 schedules of 10 existing persons
        Schedule::factory(10)->create([
            'morning_start' => '09:00',
            'morning_end' => '12:00',
            'afternoon_start' => '14:00',
            'afternoon_end' => '16:00',
        ]);
    }
}
