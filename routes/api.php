<?php

use App\Http\Controllers\admin\CaseStudyApiController;
use App\Http\Controllers\CaseStudyDesktopController;
use App\Http\Controllers\admin\BlogApiController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\HomeApiController;
use App\Http\Controllers\ClientSpeakController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StartProjectController;
use App\Http\Controllers\Clients;
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

Route::get('case-studies-desktop', [CaseStudyDesktopController::class, 'index']);
Route::get('case-studies-desktop/{id}', [CaseStudyDesktopController::class, 'get_by_id']);

Route::get('manage-blogs', [BlogApiController::class, 'index']);
Route::get('manage-blogs/{id}', [BlogApiController::class, 'show']);

Route::get('home-videos', [HomeApiController::class, 'index']);
Route::get('home-videos/{id}', [HomeApiController::class, 'show']);
// Route::resource('home-videos', HomeController::class);
Route::get('services', [ServiceController::class, 'showAll']);
Route::get('services/{id}', [ServiceController::class, 'show']);

Route::get('client-speaks', [ClientSpeakController::class, 'showAll']);
Route::get('client-speaks/{id}', [ClientSpeakController::class, 'show']);

Route::get('clients', [Clients::class, 'index']);
Route::get('clients/{id}', [Clients::class, 'show']);

Route::get('about-us', [AboutUsController::class, 'showAll']);
Route::get('about-us/{id}', [AboutUsController::class, 'show']);

Route::post("get_credentials", [StartProjectController::class, "store"]);

Route::prefix('admin')->name('admin.')->group(
    function () {
        Route::middleware(['auth:admin', 'preventBackHistory'])->group(
            function () {
                
                // Route::middleware(['auth:admin', 'preventBackHistory'])->group(function () {
                // Route::middleware(('auth:sanctum'))->post('services', [ServiceController::class, 'store']);
                // Route::post('/register', [AdminManageController::class, 'register']);
                // Route::post('/login', [AdminManageController::class, 'login'])->name('login');

            }
        );
    }
);
