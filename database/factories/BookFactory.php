<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'authors' => $this->faker->name,
            'description' => $this->faker->paragraph,
            'published' => $this->faker->date,
            'image' => 'foto.png', // Replace with a path to a default image if needed.
            // Add other attributes here...
        ];
    }
}
