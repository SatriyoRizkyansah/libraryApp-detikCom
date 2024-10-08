<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class bookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(4),
            'category_id' => random_int(1,10),
            'auther_id' => random_int(1,10),
            'publisher_id' => random_int(1,10),
            'cover' => 'covers/1723385615_images.jpg',
            'pdf' => 'pdfs/1723385615_test.pdf',
            'status' => 'Y'
        ];
    }
}
