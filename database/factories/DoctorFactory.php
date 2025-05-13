<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Speciality;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fn () => User::factory()->create(['role' => 'doctor'])->id,
            'speciality_id' => fn () => Speciality::inRandomOrder()->first()->id,
            'bio' => fake()->paragraph(),
            'experience' => fake()->numberBetween(5, 30),
            'is_featured' => true,
            'photo' => 'doctors/avatar.png',
        ];
    }
}