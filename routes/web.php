<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\PostPreLoginController;
use App\Http\Controllers\Members\PostController;
use App\Http\Controllers\Members\HomeController;
use App\Http\Controllers\Members\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/privacy-policy', [WelcomeController::class, 'getPrivacyPolicy'])->name('privacy-policy');
Route::get('/terms-condition', [WelcomeController::class, 'getTermsCondition'])->name('terms-condition');
Route::get('/cookies-policy', [WelcomeController::class, 'getCookyPolicy'])->name('cookies-policy');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/post-ad-step-1/{catSlug?}/{catSlug2?}/{catSlug3?}', [PostController::class, 'postYourAdFormStep1'])->name('new-post');
    Route::get('/post-ad-step-2/{catSlug}', [PostController::class, 'postYourAdFormStep2'])->name('new-post-step-2');
    Route::get('/post-ad-step-2/{catSlug}/{postId}', [PostController::class, 'postYourAdFormStep2'])->name('edit-post');
    Route::get('/my-ads', [PostController::class, 'getMyPosts'])->name('my-post');
    Route::get('/my-wallet', [PostController::class, 'getMyWallet'])->name('my-wallet');
    Route::get('/my-order', [PostController::class, 'getMyOrder'])->name('my-order');
    Route::get('/promote-ad', [PostController::class, 'promoteMyAd'])->name('promote-ad');
    Route::get('/cart-page', [PostController::class, 'cartPage'])->name('cart-page');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
    Route::get('/my-profile', [ProfileController::class, 'index'])->name('profile');

    Route::post('/upload-user-profie-image', [ProfileController::class, 'uploadUserProfileImage'])->name('upload-user-profie-image');
    Route::post('/remove-user-profie-image', [ProfileController::class, 'removeUserProfileImage'])->name('remove-user-profie-image'); 
   

    Route::post('/logout', function () {
        Auth::guard('web')->logout();
        return redirect()->route('login');
    })->name('logout');
});

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
    return 'Done';
});

//Route::get('/{category}/{location?}',[AdController::class, 'index'])->name('search');
Route::get('/pd/{slug}/{id}', [PostPreLoginController::class, 'getPostDetails'])->name('post-detail');
Route::get('profile/{userId}', [PostPreLoginController::class, 'getUserProfile'])->name('user-profile');
Route::get('{location}/{category?}', [PostPreLoginController::class, 'getPostLists'])->name('post-list');
