<?php

use App\Models\Appointment;


$appointments = Appointment::search('')->with('patient', 'doctor')->where('patient_id', 65)->get();
