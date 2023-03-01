<?php

namespace Database\Factories;

use App\Models\MealTag;
use Illuminate\Database\Eloquent\Factories\Factory;

    class MealTagFactory Extends Factory
            {
                protected $model = MealTag::class;

                public function definition()
                {
            return [
                'meal_id' => $this->faker->numberBetween(1, 10),
                'tag_id'  => $this->faker->numberBetween(1, 10)
            ];
        }
    }
