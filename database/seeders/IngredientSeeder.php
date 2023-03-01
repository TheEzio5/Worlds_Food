<?php

Namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ingredient;
use App\Models\IngredientTranslation;
use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

class IngredientSeeder extends Seeder
{
    /**
     * Populate ingredients & their translations.
     *
     * @return void
     */
    public function run()
    {
        // INGREDIENTS-> id, slug
        Ingredient::factory()->count(10)->create()->each(function($ingredient) {
            $languages = Language::pluck('locale', 'id')->toArray();

            // INGREDIENT_TRANSLATIONS-> ingredient_id, language_id, title
            foreach($languages as $key => $language) {
                IngredientTranslation::factory()->create($data = [
                    'ingredient_id' => $ingredient->id,
                    'language_id'   => $key,
                    'title'         => 'Ingredient-' . $ingredient->id . '-' . $language
                ]);
            }

        });
    }
}
