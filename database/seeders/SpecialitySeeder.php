<?php

namespace Database\Seeders;

use App\Models\Speciality;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SpecialitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialities = [
            [
                'name' => 'Cardiology',
                'code' => 'CARD',
                'description' => 'Deals with disorders of the heart and blood vessels',
            ],
            [
                'name' => 'Pediatrics',
                'code' => 'PED',
                'description' => 'Focuses on the health of infants, children, and adolescents',
            ],
            [
                'name' => 'Neurology',
                'code' => 'NEUR',
                'description' => 'Treats disorders of the nervous system',
            ],
            [
                'name' => 'Orthopedics',
                'code' => 'ORTH',
                'description' => 'Deals with conditions of the musculoskeletal system',
            ],
            [
                'name' => 'Dermatology',
                'code' => 'DERM',
                'description' => 'Focuses on conditions affecting the skin',
            ],
            [
                'name' => 'Ophthalmology',
                'code' => 'OPTH',
                'description' => 'Deals with disorders of the eyes',
            ],
            [
                'name' => 'Psychiatry',
                'code' => 'PSYC',
                'description' => 'Treats mental health disorders',
            ],
            [
                'name' => 'Gynecology',
                'code' => 'GYN',
                'description' => 'Focuses on women\'s reproductive health',
            ],
            [
                'name' => 'Dentistry',
                'code' => 'DENT',
                'description' => 'Deals with oral health and dental care',
            ],
            [
                'name' => 'Endocrinology',
                'code' => 'ENDO',
                'description' => 'Treats disorders of the endocrine system and hormones',
            ],
        ];

        // Disable foreign key checks for mySQL
        // DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Disable foreign key checks for SQLite
        DB::statement('PRAGMA foreign_keys = OFF');

        // Clear existing records
        Speciality::truncate();

        foreach ($specialities as $speciality) {
            Speciality::create([
                'name' => $speciality['name'],
                'code' => $speciality['code'],
                'slug' => Str::slug($speciality['name']),
                'description' => $speciality['description'],
                'status' => true,
            ]);
        }

        // Enable foreign key checks for mySQL
        // DB::statement('SET FOREIGN_KEY_CHECKS=01');

        // Enable foreign key checks for SQLite
        DB::statement('PRAGMA foreign_keys = ON');
    }
}