<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Meal;
use App\Models\MealTranslation;
use App\Models\MealTag;
use App\Models\MealIngredient;
use App\Models\Language;
use Database\Factories\MealTranslationFactory;

class MealSeeder extends Seeder
{
    /**
     * Populate meals, their translations, meal/tags, meal/ingredients.
     *
     * @return void
     */
    public function run()
    {
        // MEAL-> id, slug, category_id, created_at, updated_at, deleted_at
        Meal::factory()->count(20)->create()->each(function($meal) {
            $faker = \Faker\Factory::create();
            $languages = Language::pluck('locale', 'id')->toArray();

            // make title from slug
            $title = substr(str_replace('-', ' ', $meal->slug), 0, -2);
            $title = ucfirst($title);

            // MEAL_TRANSLATIONS-> meal_id, language_id, title, description
            foreach($languages as $key => $language) {
                MealTranslationFactory::new()->create($data = [
                    'meal_id'     => $meal->id,
                    'language_id' => $key,
                    'title'       => $title . ' ('.$language.')',
                    'description' => $faker->text($maxNbChars = 300) . ' ('.$language.')'
                ]);
            }

            // MEAL/TAGS-> meal_id, tag_id (without duplicates)
            $tag_ids = [];
            $num_of_tags = mt_rand(1,5);
            for ($i=0; $i < $num_of_tags; $i++) {
                $tag_ids[] = $faker->unique()->numberBetween(1,10);
                MealTag::factory()->create($data = [
                    'meal_id' => $meal->id,
                    'tag_id'  => $tag_ids[$i]
                ]);
            }

            // MEAL/INGREDIENTS-> meal_id, ingredient_id (without duplicates)
            $ingredient_ids = [];
            $num_of_ingredients = mt_rand(1,5);
            for ($i=0; $i < $num_of_ingredients; $i++) {
                $ingredient_ids[] = $faker->unique()->numberBetween(1,10);
                MealIngredient::factory()->create($data = [
                    'meal_id'       => $meal->id,
                    'ingredient_id' => $ingredient_ids[$i]
                ]);
            }

        });
    }
}
