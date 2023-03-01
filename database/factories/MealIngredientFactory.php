<?php

namespace Database\Factories;

use App\Models\MealIngredient;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class MealIngredientFactory Extends Factory

    {
        protected $model = MealIngredient::class;
        public function definition()
            {
                return [
                    'meal_id'       => $this->faker->numberBetween(1, 10),
                    'ingredient_id' => $this->faker->numberBetween(1, 10)
                ];
            }
    }
