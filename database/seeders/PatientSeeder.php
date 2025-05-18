<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Patient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks for mySQL
        // DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Disable foreign key checks for SQLite
        DB::statement('PRAGMA foreign_keys = OFF');

        // Clear existing records
        Patient::truncate();

        $patients = User::where('role', 'patient')->get();
        foreach ($patients as $patient) {
            Patient::create([
                'user_id' => $patient->id,
            ]);
        }

        // Enable foreign key checks for mySQL
        // DB::statement('SET FOREIGN_KEY_CHECKS=01');

        // Enable foreign key checks for SQLite
        DB::statement('PRAGMA foreign_keys = ON');
    }
}
