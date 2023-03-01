<?php

namespace Database\Factories;

use App\Models\MealTranslation;
use Faker\Generator as Faker;
use illuminate\Database\Eloquent\Factories\Factory;

class MealTranslationFactory Extends Factory

{

    protected $mode = MealTranslation::class;
    public function definition()
    {
        return [
            'meal_id'      => $this->faker->numberBetween(1, 10),
            'language_id'  => $this->faker->numberBetween(1, 4),
            'title'        => $this->faker->words(3, true),
            'description'  => $this->faker->text($maxNbChars = 50)
            ];
        }
    }
