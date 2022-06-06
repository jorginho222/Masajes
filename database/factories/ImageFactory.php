<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $fileName = $this->faker->numberBetween(1, 6) . '.jpg';

        return [
            'path' => "img/services/{$fileName}"
        ];
    }

    public function user()
    {
        $fileName = $this->faker->numberBetween(1, 7) . '.jpg';

        return $this->state([
            'path' => "images/users/{$fileName}"
        ]);
    }

    // public function course()
    // {
    //     $fileName = $this->faker->numberBetween(1, 7) . '.jpg';

    //     return $this->state([
    //         'path' => "images/users/{$fileName}"
    //     ]);
    // }

    public function post()
    {
        $fileName = $this->faker->numberBetween(1, 5) . '.jpg';

        return $this->state([
            'path' => "images/posts/{$fileName}"
        ]);
    }
}
