<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    use HasFactory;
    public $timestamps = false;

    /**
     * One tag has many translations (1-M)
     */
    public function translations()
    {
        return $this->hasMany('App\Models\TagTranslation', 'tag_id', 'id')
                    ->orderBy('language_id', 'asc');
    }

    /**
     * One tag belongs to many meals (M-M)
     */
    public function meals()
    {
        return $this->belongsToMany('App\Meal', 'meal_tags', 'tag_id', 'meal_id');
    }
}
