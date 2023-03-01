<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meal extends Model
{

    use HasFactory;
    use SoftDeletes;
    protected $hidden = ['pivot', 'translations'];

    /**
     * One meal has many translations (1-M)
     */
    public function translations()
    {
        return $this->hasMany('App\Models\MealTranslation', 'meal_id', 'id')
                    ->orderBy('language_id', 'asc');
    }

    /**
     * One meal belongs to one category (1-1)
     */
    public function category()
    {
    	return $this->belongsTo('App\Models\Category', 'category_id', 'id')
                    ->orderBy('id', 'asc');
    }

    /**
     * One meal belongs to many ingredients (M-M)
     */
    public function ingredients()
    {
        return $this->belongsToMany('App\Models\Ingredient', 'meal_ingredients', 'meal_id', 'ingredient_id')
                    ->orderBy('ingredient_id', 'asc');
    }

    /**
     * One meal belongs to many tags (M-M)
     */
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'meal_tags', 'meal_id', 'tag_id')
                    ->orderBy('tag_id', 'asc');
    }

    /**
     * Get meal status
     */
    public function status()
    {
        $status = 'created';
        if (!request()->has('diff_time')) return $status;

        if ($this->deleted_at != null) {
            $status = 'deleted';
        } elseif ($this->created_at != $this->updated_at) {
            $status = 'modified';
        }
        return $status;
    }

    /**
     * Get meal TRANSLATION
     */
    public function scopeGetMealTranslation($query, $lang)
    {
        return $query->with(['translations' => function($query) use($lang) {
            $query->where('language_id', $lang);
        }]);
    }

    /**
     * Filter: CATEGORY
     */
    public function scopeFilterByCategory($query, $category)
    {
        if (!$category) return $query;
        if (!is_numeric($category)) $category = strtolower($category);

        if (is_numeric($category)) {
            $query->where('category_id', (int)$category);
        } elseif ($category == 'null') {
            $query->whereNull('category_id');
        } elseif ($category == '!null') {
            $query->whereNotNull('category_id');
        }
        return $query;
    }

    /**
     * Filter: TAGS
     */
    public function scopeFilterByTags($query, $tags)
    {
        if (empty($tags)) return $query;
        foreach ($tags as $key => $tag) {
            $query->whereHas('tags', function ($query) use ($tag) {
                $query->where('tag_id', (int)$tag);
            });
        }
        return $query;
    }

    /**
     * Filter: DIFF_TIME
     */
    public function scopeFilterByDiffTime($query, $diff_time)
    {
        if (!$diff_time) return $query;
        return $query->withTrashed()
              ->where('created_at', '>', date('Y-m-d H:i:s', $diff_time));
    }

    /**
     * Filter: PROPERTIES (with = tags,category,ingredients)
     */
    public function scopeGetProperties($query, $with, $lang)
    {
        if (empty($with)) return $query;
        // for every property, set relationship (tags.translations...)
        foreach ($with as $key => $property) {
            $query->with([$property.'.translations' => function($query) use($lang) {
                $query->where('language_id', $lang);
            }]);
        }
        return $query;
    }

}
