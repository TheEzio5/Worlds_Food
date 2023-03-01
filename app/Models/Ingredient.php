<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{

    use HasFactory;
    public $timestamps = false;

    /**
     * One ingredient has many translations (1-M)
     */
    public function translations()
    {
        return $this->hasMany('App\Models\IngredientTranslation', 'ingredient_id', 'id')
                    ->orderBy('language_id', 'asc');
    }

    /**
     * One ingredient belongs to many meals (M-M)
     */
    public function meals()
    {
        return $this->belongsToMany('App\Meal', 'meal_ingredients', 'ingredient_id', 'meal_id');
    }
}
