<?php

namespace Database\Factories;

use App\Models\IngredientTranslation;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

    class IngredientTranslationFactory extends Factory

    {
        protected $mode = IngredientTranslation::class;

        public function definition()
        {
            return [
                'ingredient_id' => $this->faker->numberBetween(1, 10),
                'language_id'   => $this->faker->numberBetween(1, 3),
                'title'         => $this->faker->words(3, true)
                ];
        }
    }
