<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Meal;
use App\Models\IngredientTranslation;
use App\Models\Language;
use App\Http\Resources\MealCollection;
use App\Http\Requests\ValidateMealRequest;

class MealController extends Controller
{
    public function index(ValidateMealRequest $request)
    {
        // $validated = $request->validated();
        // echo '<pre>'. print_r( $validated, true ) . '</pre>';

        // parameters
        $per_page   = $request->query('per_page', 5);
        // $page       = $request->query('page', 1);
        $category   = $request->query('category', '');
        $tags       = $request->query('tags', []);
        $with       = $request->query('with', []);
        $lang       = $request->query('lang');
        $diff_time  = $request->query('diff_time');


        // get language id using received parameter (its already checked if it exists during validation)
        $lang = Language::where('locale', $lang)->pluck('id')[0];

        // query meals
        $meals = Meal::getMealTranslation($lang)
                     ->filterByCategory($category)
                     ->filterByTags($tags)
                     ->filterByDiffTime($diff_time)
                     ->getProperties($with, $lang)
                     ->orderBy('id')
                     ->paginate((int)$per_page)
                     ->withQueryString();

        // gather collection of meals
        $collection = new MealCollection($meals);

        // echo '<pre>'.print_r(json_encode($collection, JSON_PRETTY_PRINT), true).'</pre>';
        // return $collection;
        return response()->json($collection, 200);
    }
}
