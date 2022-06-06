<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(8),
            'day' => $this->faker->dayOfWeek(),
            'init_time' => $this->faker->time('H:i:s'),
            'finish_time' => $this->faker->time('H:i:s'),
            'init_date' => $this->faker->date('d-m-Y'),
            'duration' => $this->faker->numberBetween(3, 9),
            'capacity' => $this->faker->numberBetween(10, 15),
            'fee' => $this->faker->numberBetween(3000, 5500),
            'enrollment' => $this->faker->numberBetween(3000, 5500),
        ];
    }
}
