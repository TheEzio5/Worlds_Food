<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\TagTranslation;
use App\Models\Language;

class TagSeeder extends Seeder
{
    /**
     * Populate tags & their translations.
     *
     * @return void
     */
    public function run()
    {
        // TAGS-> id, slug
        Tag::factory()->count(10)->create()->each(function($tag) {
            $languages = Language::pluck('locale', 'id')->toArray();

            // TAG_TRANSLATIONS-> tag_id, language_id, title
            foreach($languages as $key => $language) {
                TagTranslation::factory()->create($data = [
                    'tag_id'      => $tag->id,
                    'language_id' => $key,
                    'title'       => 'Tag-' . $tag->id . '-' . $language
                ]);
            }

        });
    }
}
