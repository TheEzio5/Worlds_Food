<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\Language;

class CategorySeeder extends Seeder
{
    /**
     * Populate categories & their translations.
     *
     * @return void
     */
    public function run()
    {
        // CATEGORIES-> id, slug
        Category::factory()->count(10)->create()->each(function($category) {
            $languages = Language::pluck('locale', 'id')->toArray();

            // CATEGORY_TRANSLATIONS-> category_id, language_id, title
            foreach($languages as $key => $language) {
                CategoryTranslation::factory()->create($data = [
                    'category_id' => $category->id,
                    'language_id' => $key,
                    'title'       => 'Category-' . $category->id . '-' . $language
                ]);
            }

        });
    }
}
