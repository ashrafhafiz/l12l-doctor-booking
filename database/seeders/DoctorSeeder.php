<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Speciality;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorSeeder extends Seeder
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
        Doctor::truncate();

        // Create specialities first if they don't exist
        if (Speciality::count() === 0) {
            Speciality::factory(10)->create();
        }

        // Get all speciality IDs
        $specialityIds = Speciality::pluck('id')->toArray();

        // Get all existing users with doctor role
        $doctorUsers = User::where('role', 'doctor')->get();

        // Create doctor records for existing doctor users
        $specialityCount = count($specialityIds);
        foreach ($doctorUsers as $index => $user) {
            // Use modulo to loop through speciality IDs sequentially
            $specialityIndex = $index % $specialityCount;
            
            Doctor::factory()
                ->create([
                    'user_id' => $user->id,
                    'speciality_id' => $specialityIds[$specialityIndex],
                ]);
        }

        // Enable foreign key checks for mySQL
        // DB::statement('SET FOREIGN_KEY_CHECKS=01');

        // Enable foreign key checks for SQLite
        DB::statement('PRAGMA foreign_keys = ON');
    }
}