<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hospital extends Model
{
    /** @use HasFactory<\Database\Factories\HospitalFactory> */
    use HasFactory;

    public function doctors(): HasMany
    {
        return $this->hasMany(Doctor::class);
    }
}