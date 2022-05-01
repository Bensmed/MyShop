<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Nette\Utils\Random;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Banner>
 */
class BannerFactory extends Factory
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
            'title' => $this->faker->words($nb = 2, $asText = true),
            'paragraph' => $this->faker->words($nb = 4, $asText = true),
            'button' => $button,
            'link' => Str::slug($button),
            'image_name' => $this->faker->imageUrl($width = 570, $height = 300),
            'type' => 'dark',
        ];
    }
}
