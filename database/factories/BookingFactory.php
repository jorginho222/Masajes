<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'date' => now(),
            'time' => $this->faker->time($format= 'H:i:s', $max= '17:00:00'),
            'user_id' => $this->faker->numberBetween(1, 20),
        ];
    }
}
