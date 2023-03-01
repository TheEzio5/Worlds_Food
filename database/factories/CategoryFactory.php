<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory

    {
        protected $model = Category::class;
        public function definition()
        {
            static $id = 0;
            $id++;

            return [
                'id'   => $id,
                'slug' => 'category-' . $id
                   ];
        }
    }
