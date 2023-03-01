<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;
use Database\Factories\LanguageFactory;

class LanguageSeeder extends Seeder
{
    /**
     * Populate languages.
     *
     * @return void
     */
    public function run()
    {
        Language::factory()->count(4)->create();
    }
}
