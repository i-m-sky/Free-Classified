<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\State;
use App\Models\City;
use App\Models\Locality;
use App\Models\Category;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/search-location', function (Request $request) {
    $type = $request->type;
    $className = ($type == 'search') ? 'search-list' : 'search-list-post';
    $search = $request->location;
    $states  = State::where('name', 'like', '' . $search . '%')->where('status', 'active')->select(['id', 'name', 'slug'])->get();
    $cities  = City::where('name', 'like', '' . $search . '%')->where('status', 'active')->select(['id', 'name', 'slug', 'state_id'])->get();
    $localities  = Locality::where('name', 'like', '' . $search . '%')->where('status', 'active')->select(['id', 'name', 'slug', 'city_id', 'state_id'])->get();
    $results = '<ul id="' . $className . '">';

    if ($states->count() > 0) {
        $results .= '<li> <div class="txt-bold">State</div>';
        foreach ($states as $state) {
            $stateName = str_replace($search, "<b class='search-text-bold'>" . $search . "</b>", $state->name);
            $stateName = str_replace(ucwords($search), "<b class='search-text-bold'>" . ucwords($search) . "</b>", $state->name);
            $results .= '<div class="' . $className . '" data-slug="' . $state->slug . '" data-name="' . $state->name . '" data-id="' . $state->id . '"  data-type="state">' . $stateName;
            $results .= '</div>';
        }
        $results .= '</li>';
    }
    if ($cities->count() > 0) {
        $results .= '<li> <div class="txt-bold">City</div>';
        foreach ($cities as $city) {
            $stateName = str_replace($search, "<b class='search-text-bold'>" . $search . "</b>", $city->state->name);
            $cityName = str_replace($search, "<b class='search-text-bold'>" . $search . "</b>", $city->name);
            $stateName = str_replace(ucwords($search), "<b class='search-text-bold'>" . ucwords($search) . "</b>", $city->state->name);
            $cityName = str_replace(ucwords($search), "<b class='search-text-bold'>" . ucwords($search) . "</b>", $city->name);

            $results .= '<div class="' . $className . '" data-slug="' . $city->slug . '" data-name="' . $city->name . '"  data-id="' . $city->id . '"  data-type="city">' . $cityName . ', ' . $stateName;
            $results .= '</div>';
        }
        $results .= '</li>';
    }
    if ($localities->count() > 0) {
        $results .= '<li><div class="txt-bold">Lacality</div>';
        foreach ($localities as $locality) {
            $stateName = str_replace($search, "<b class='search-text-bold'>" . $search . "</b>", $locality->state->name);
            $cityName = str_replace($search, "<b class='search-text-bold'>" . $search . "</b>", $locality->city->name);
            $localityName = str_replace($search, "<b class='search-text-bold'>" . $search . "</b>", $locality->name);
            $stateName = str_replace(ucwords($search), "<b class='search-text-bold'>" . ucwords($search) . "</b>", $locality->state->name);
            $cityName = str_replace(ucwords($search), "<b class='search-text-bold'>" . ucwords($search) . "</b>", $locality->city->name);
            $localityName = str_replace(ucwords($search), "<b class='search-text-bold'>" . ucwords($search) . "</b>", $locality->name);
            $results .= '<div class="' . $className . '" data-slug="' . $locality->slug . '" data-name="' . $locality->name . '"  data-id="' . $locality->id . '"  data-type="locality">' . $localityName . ', ' . $cityName . ', ' . $stateName;
            $results .= '</div>';
        }
        $results .= '</li>';
    }
    $results .= '</ul>';
    echo $results;
})->name('search-location'); //end getSearchLocation


Route::post('/search-categories', function (Request $request) {
    $className = 'search-list-category';
    $search = $request->search;

    $categories  = Category::where('name', 'like', '' . $search . '%')->where('status', 'active')->select(['id', 'name', 'slug', 'parent_id'])->get();//->where('parent_id', 0)
    $results = '<ul id="' . $className . '">';

    $results .= '<li>';
    $results .= '<div class="' . $className . '" data-slug="' . $search . '" data-name="' . $search . '"  data-id="search"  data-type="search">Search ' . $search;
    $results .= '</div>';
    $results .= '</li>';
    if ($categories->count() > 0) {
        $results .= '<li>';
        foreach ($categories as $cat) {
            $categoryName = str_replace(ucwords($search), "<b class='search-text-bold'>" . ucwords($search) . "</b>", $cat->name);
            $results .= '<div class="' . $className . '" data-slug="' . $cat->slug . '" data-name="' . $cat->name . '"  data-id="' . $cat->id . '"  data-type="category">' . $categoryName;
            $results .= '</div>';
        }
        $results .= '</li>';
    }
    $results .= '</ul>';
    echo $results;
})->name('search-categories');
