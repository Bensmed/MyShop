<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // return [
        //     'code' => 'ABC123',
        //     'type' => 'percent',
        //     'value' => 50,
        //     'max_usage' => 10,
        //     'expiration_date' => date("Y-m-d H:i:s")
        // ];

        return [
            'code' => 'DEF456',
            'type' => 'fixed',
            'value' => 50,
            'max_usage' => 10,
            'expiration_date' => date("Y-m-d H:i:s")
        ];
    }
}
