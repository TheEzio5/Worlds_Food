<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $timestamps = false;

    /**
     * One category has many translations (1-M)
     */
    public function translations()
    {
        return $this->hasMany('App\Models\CategoryTranslation', 'category_id', 'id')
                    ->orderBy('language_id', 'asc');
    }
}
