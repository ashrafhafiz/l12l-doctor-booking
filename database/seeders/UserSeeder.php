<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
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
        User::truncate();
        
         User::factory()->create([
            'name' => 'System Admin',
            'email' => 'admin@example.com',
            'role' => 'admin'
        ]);
        
        User::factory(30)->create([
            'role' => 'doctor'
        ]);

        User::factory(70)->create([ 
            'role' => 'patient'
        ]);

        // Enable foreign key checks for mySQL
        // DB::statement('SET FOREIGN_KEY_CHECKS=01');

        // Enable foreign key checks for SQLite
        DB::statement('PRAGMA foreign_keys = ON');
    }
}