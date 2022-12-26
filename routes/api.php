<?php

use App\Http\Controllers\admin\CaseStudyApiController;
use App\Http\Controllers\admin\BlogApiController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::resource('case-studies', CaseStudyApiController::class);
// Route::resource('manage-blogs', BlogApiController::class);
// Route::resource('home-videos', HomeController::class);

Route::get('case-studies', [CaseStudyApiController::class, 'index']);
Route::get('case-studies/{id}', [CaseStudyApiController::class, 'show']);

Route::get('manage-blogs', [BlogApiController::class, 'index']);
Route::get('manage-blogs/{id}', [BlogApiController::class, 'show']);

Route::get('home-videos', [HomeController::class, 'index']);
Route::get('home-videos/{id}', [HomeController::class, 'show']);
// Route::resource('home-videos', HomeController::class);
Route::get('services', [ServiceController::class, 'showAll']);
Route::get('services/{id}', [ServiceController::class, 'show']);

Route::prefix('admin')->name('admin.')->group(
    function () {
        // Route::middleware(['auth:admin', 'preventBackHistory'])->group(function () {
        // Route::middleware(('auth:sanctum'))->post('services', [ServiceController::class, 'store']);
        // Route::post('/register', [AdminManageController::class, 'register']);
        // Route::post('/login', [AdminManageController::class, 'login'])->name('login');

        // });
    }
);
