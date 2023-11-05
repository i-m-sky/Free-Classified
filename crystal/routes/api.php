<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*
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

Route::get('cities/{state}', function ($state_id) {
    $races = DB::table('cities as c')
        ->where('c.state_id', $state_id)
        ->select(['c.id', 'c.name'])->orderBy('c.name')->get();
    return $races->map(function ($i) {
        return ['value' => $i->id, 'display' => $i->name];
    });
}); //->middleware(['nova']);



Route::get('localities/{city_id}', function ($city_id) {
    $races = DB::table('localities as l')
        ->where('l.city_id', $city_id)
        ->select(['l.id', 'l.name'])->orderBy('l.name')->get();
    return $races->map(function ($i) {
        return ['value' => $i->id, 'display' => $i->name];
    });
}); //->middleware(['nova']);



Route::get('user-phone/{user}', function ($user_id) {
    $user = DB::table('users as u')
        ->where('u.id', $user_id)
        ->select(['u.phone', 'u.phone_verified_at'])->first();
    if (!empty($user) && !empty($user->phone)) {
        if (!empty($user->phone_verified_at)) {
            return [
                ['value' => 1, 'display' => $user->phone],
                ['value' => 2, 'display' => 'None']
            ];
        } else {
            return [
                ['value' => 2, 'display' => $user->phone . '(not verified,
                please verify your number)'],
                ['value' => 2, 'display' => 'None']
            ];
        }
    } else {
        return ['value' => 2, 'display' => 'None'];
    }
});//->middleware(['nova']);
