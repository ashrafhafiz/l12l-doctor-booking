<?php

namespace App\Filament\Doctor\Resources\DoctorScheduleResource\Pages;

use Filament\Actions;
use App\Models\DoctorSchedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Doctor\Resources\DoctorScheduleResource;

class CreateDoctorSchedule extends CreateRecord
{
    protected static string $resource = DoctorScheduleResource::class;

    // protected function handleRecordCreation(array $data): DoctorSchedule
    // {
    //     $doctorSchedule = DoctorSchedule::create($data);
    //     return $doctorSchedule;
    // }

    protected function handleRecordCreation(array $data): Model
    {
        $data['doctor_id'] = Auth::user()->doctor->id;
        return static::getModel()::create($data);
    }
}