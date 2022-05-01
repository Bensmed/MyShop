<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Settings>
 */
class SettingsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            /*
    |--------------------------------------------------------------------------
    | Website INFORMATIONS
    |--------------------------------------------------------------------------
    */

            'website_title' => 'Furnish',
            'website_description' => 'Gravida nibh vel velit auctor aliquetn quibibendum auci elit cons equat ipsutis sem nibh id elit.',

            /*
    |--------------------------------------------------------------------------
    | Website LOGO
    |--------------------------------------------------------------------------
    */

            'logo' => 'assets/images/logo.png',
            'favicon' => 'assets/images/favicon.png',

            /*
    |--------------------------------------------------------------------------
    | Website COLORS
    |--------------------------------------------------------------------------
    */

            'primary_color' => 'rgb(19, 187, 137)',
            'hover_color' => 'rgb(16, 160, 118)',
            'transparent_color' => 'rgba(19, 187, 137, 0.5)',

            /*
    |--------------------------------------------------------------------------
    | Owner INFORMATION
    |--------------------------------------------------------------------------
    */

            'email' => 'contact@myshop.com',
            'address' => 'Bois des cars 2, Dely Ibrahim, Alger',
            'phone1' => '+213(0)-6 60 70 80 90',
            'phone2' => '+213(0)-7 70 80 90 00',

            /*
    |--------------------------------------------------------------------------
    | Owner SOCIAL MEDIA
    |--------------------------------------------------------------------------
    */

            'facebook' => 'https://www.facebook.com',
            'twitter' => 'https://www.twitter.com',
            'instagram' => 'https://www.instagram.com',

            /*
    |--------------------------------------------------------------------------
    | Store INFORMATION
    |--------------------------------------------------------------------------
    */

            'currency' => 'DZD',
        ];
    }
}
