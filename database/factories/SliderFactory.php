<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slider>
 */
class SliderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $button = $this->faker->words($nb = 3, $asText = true);
        return [
            'title' => $this->faker->sentence($nbWords = 4, $variableNbWords = true),
            'paragraph' => $this->faker->sentence($nbWords = 20, $variableNbWords = true),
            'badge' => $this->faker->numberBetween($min = 10, $max = 50) . "% OFF",
            'button' => $button,
            'link' => Str::slug($button),
            'image_name' => $this->faker->imageUrl($width = 770, $height = 950),
        ];
    }
}
