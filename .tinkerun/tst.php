<?php

use App\Models\DoctorSchedule;

$schedules = App\Models\DoctorSchedule::where('doctor_id', 2)
    ->get();
$availability = [];
foreach ($schedules as $schedule) {
    $dayOfWeek = $schedule->available_day; //1 - monday, 2 - tuesday, etc.
    $fromTime = Carbon\Carbon::createFromFormat('H:i:s', $schedule->start_time);
    $toTime = Carbon\Carbon::createFromFormat('H:i:s', $schedule->end_time);
    $availability[$dayOfWeek] = [
        'from' => $fromTime,
        'to' => $toTime,
    ];
}

$dates = [];
$today = Carbon\Carbon::today();
for ($i = 0; $i < 365; $i++) { //1 year
    $date = $today->copy()->addDays($i);
    $dayOfWeek = $date->dayOfWeek - 1;

    if ($dayOfWeek < 0) {
        $dayOfWeek = 6;
    }

    if (isset($availability[$dayOfWeek])) {
        $dates[] = $date->format('Y-m-d');
    }
};

$dates;