<?php

namespace Database\Factories;

use App\Models\CategoryTranslation;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryTranslationFactory Extends Factory

    {
        protected $mode = CategoryTranslation::class;
        public function definition()
        {
        return [
            'category_id' => $this->faker->numberBetween(1, 10),
            'language_id' => $this->faker->numberBetween(1, 10),
            'title'       => $this->faker->words(3, true)
                ];
        }
    }
