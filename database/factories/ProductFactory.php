<?php


namespace Database\Factories;

require_once 'vendor/autoload.php';

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->text(25);
        $price = $this->faker->numberBetween($min = 100, $max = 900);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->text(100),
            'image_name' => $this->faker->imageUrl($width = 140, $height = 300),
            'price' => $price,
            'sale_price' => $price - 50,
            'category_id' => $this->faker->numberBetween($min = 1, $max = 10),
        ];
    }
}
