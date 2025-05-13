<?php

namespace Database\Seeders;

use App\Models\Hospital;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hospitals = [
            [
                'name' => 'Kasr Al Ainy Hospital (Cairo University Hospitals)',
                'address' => 'Cairo',
                'phone' => '123-456-7890',
                'email' => 'hospital@example.com',
                'website'=> 'www.hospital.com',
                'image'=> 'hospitals/1.jpg',
            ],
            [
                'name' => 'Qasr Al Ainy French Hospital',
                'address' => 'Cairo',
                'phone' => '123-456-7890',
                'email' => 'hospital@example.com',
                'website'=> 'www.hospital.com',
                'image'=> 'hospitals/2.jpg',
            ],
            [
                'name' => 'Al Salam International Hospital',
                'address' => 'Maadi - Cairo',
                'phone' => '123-456-7890',
                'email' => 'hospital@example.com',
                'website'=> 'www.hospital.com',
                'image'=> 'hospitals/3.jpg',
            ],
            [
                'name' => 'Dar Al Fouad Hospital',
                'address' => '6th of October City',
                'phone' => '123-456-7890',
                'email' => 'hospital@example.com',
                'website'=> 'www.hospital.com',
                'image'=> 'hospitals/4.jpg',
            ],
            [
                'name' => 'Cleopatra Hospital',
                'address' => 'Heliopolis, Cairo',
                'phone' => '123-456-7890',
                'email' => 'hospital@example.com',
                'website'=> 'www.hospital.com',
                'image'=> 'hospitals/5.jpg',
            ],
            [
                'name' => 'As-Salam International Hospital',
                'address' => 'New Cairo & Maadi',
                'phone' => '123-456-7890',
                'email' => 'hospital@example.com',
                'website'=> 'www.hospital.com',
                'image'=> 'hospitals/6.jpg',
            ],
            [
                'name' => 'Misr International Hospital',
                'address' => 'Dokki, Giza',
                'phone' => '123-456-7890',
                'email' => 'hospital@example.com',
                'website'=> 'www.hospital.com',
                'image'=> 'hospitals/7.jpg',
            ],
            [
                'name' => 'Saudi German Hospital Cairo',
                'address' => 'New Cairo',
                'phone' => '123-456-7890',
                'email' => 'hospital@example.com',
                'website'=> 'www.hospital.com',
                'image'=> 'hospitals/8.jpg',
            ],
            [
                'name' => 'El Nada Hospital',
                'address' => 'Mohandessin, Giza',
                'phone' => '123-456-7890',
                'email' => 'hospital@example.com',
                'website'=> 'www.hospital.com',
                'image'=> 'hospitals/9.jpg',
            ],
            [
                'name' => 'October International Hospital',
                'address' => '6th of October City',
                'phone' => '123-456-7890',
                'email' => 'hospital@example.com',
                'website'=> 'www.hospital.com',
                'image'=> 'hospitals/10.jpg',
            ],
        ];

         // Disable foreign key checks for mySQL
        // DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Disable foreign key checks for SQLite
        DB::statement('PRAGMA foreign_keys = OFF');

        // Clear existing records
        Hospital::truncate();

        foreach ($hospitals as $hospital) {
            Hospital::create($hospital);
        };


        // Enable foreign key checks for mySQL
        // DB::statement('SET FOREIGN_KEY_CHECKS=01');

        // Enable foreign key checks for SQLite
        DB::statement('PRAGMA foreign_keys = ON');
    }
}