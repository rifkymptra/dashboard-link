<?php

namespace Database\Factories;

use App\Models\Section;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Links>
 */
class LinkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'link_name' => fake()->word(),
            'url' => fake()->url(),
            'description_link' => fake()->sentence(20),
            'vpn' => fake()->boolean(),
            'instansi' => fake()->word(),
            'section_id' => Section::all()->random()->id,
            'submitted_by' => User::all()->random()->id,
            'approved_by' => User::all()->random()->id,
            'status' => fake()->randomElement(['submitted', 'approved', 'rejected']),
            'note' => fake()->sentence(8),
        ];
    }
}
