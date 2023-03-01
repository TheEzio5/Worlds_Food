<?php

namespace Database\Factories;


use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class LanguageFactory extends Factory
{
    protected $model = Language::class;

public function definition()
    {

        static $id = 0;
        $id++;
        $languages = ['Croatian', 'English', 'Bengali', 'Hindi'];
        $locales = ['hr', 'en', 'bn_IN', 'hi_IN'];

        return [
            'id'       => $id,
            'language' => $languages[$id-1],
            'locale'   => $locales[$id-1]
        ];
    }
}
