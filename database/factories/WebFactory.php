<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Web>
 */
class WebFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $url = $this->faker->url();
        $domain = str_replace('www.', '', substr($url, strpos($url, '/')+2));
        $name = substr($domain, 0, strpos($domain, '/'));
        $description = $this->faker->text();

        return [
            'name' => $name,
            'url' => $url,
            'description' => $description
        ];
    }
}