<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    /** @use HasFactory<\Database\Factories\AppointmentFactory> */
    use HasFactory;

    public function scopeSearch($query, $value)
    {
        return $query->where('appointment_date', 'like', "%{$value}%")
            ->orWhere('appointment_time', 'like', "%{$value}%")
            ->orWhereHas('doctor.user', function ($q) use ($value) {
                $q->where('name', 'like', "%{$value}%");
            })
            ->orWhereHas('patient', function ($q) use ($value) {
                $q->where('name', 'like', "%{$value}%");
            });
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }
}
