<?php

namespace Database\Factories;

use App\Models\TagTranslation;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagTranslationFactory extends Factory
{
    protected $mode = TagTranslation::class;

    public function definition()
    {

            return [
                'tag_id'      => $this->faker->numberBetween(1, 10),
                'language_id' => $this->faker->numberBetween(1, 3),
                'title'       => $this->faker->words(3, true)
                ];
    }
}
