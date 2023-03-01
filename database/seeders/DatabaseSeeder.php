<?php

namespace Database\Seeders;

use Database\Factories\LanguageFactory;
use Illuminate\Database\Seeder;
use App\Models\Language;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LanguageSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(IngredientSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(MealSeeder::class);
    }
}
