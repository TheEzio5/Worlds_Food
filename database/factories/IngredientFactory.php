<?php

namespace Database\Factories;


use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Factories\Factory;

    class IngredientFactory extends Factory

    { protected $model =Ingredient::class;

        public function definition()
            {
                static $id = 0;
                $id++;

                return [
                            'id'   => $id,
                            'slug' => 'ingredient-' . $id
                    ];
            }
}
