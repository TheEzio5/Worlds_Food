<?php

namespace Database\Factories;

use App\Models\Meal;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MealFactory extends Factory
{
    protected $model = Meal::class;

    public function definition()
    {
        static $id = 0;
        $id++;

        // get random category (or null)
        $categories = Category::pluck('id')->toArray();
        $categories[] = null;
        $category = $categories[array_rand($categories, 1)];

        // timestamps (in the last 25 days, 20 meals are created, 1/day)
        $created_at = Carbon::now()->subDays(25-$id);
        $updated_at = $created_at;
        $deleted_at = null;

        // every 5th meal (5,10,15,20) was updated 2-4 days after creation
        if ($id % 5 == 0) {
            $updated_at = Carbon::now()->subDays((25-$id)-mt_rand(2,4));
        }

        // every 6th meal (6,12,18) was deleted 2-4 days after creation
        if ($id % 6 == 0) {
            $deleted_at = Carbon::now()->subDays((25-$id)-mt_rand(2,4));
        }

        return [
            'id' => $id,
            'slug' => $this->faker->slug . '-' . $id,
            'category_id' => $category,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
            'deleted_at' => $deleted_at,
        ];
    }
}
