<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientSpeakController;
use App\Http\Controllers\admin\HomeApiController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CaseStudyController;
use App\Http\Controllers\CaseStudyDesktopController;
use App\Http\Controllers\UserPageController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\StartProjectController;
use App\Http\Controllers\ServiceDesktopController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\Clients;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [AdminController::class, 'login']);
Route::get('/start-project', [UserPageController::class, 'startProject'])->name('startProject');
Route::get('/customers', [UserPageController::class, 'customers'])->name('customers');
Route::get('/case-study', [UserPageController::class, 'caseStudy'])->name('caseStudy');
Route::get('/get/case-study/more/{num}', [CaseStudyController::class, 'getMore']);
Route::get('/get/case-study/all', [CaseStudyController::class, 'getAll']);
Route::get('/blogs', [UserPageController::class, 'blog'])->name('blogs');
Route::get('/see/more/blog', [BlogController::class, 'fetchBlog']);
Route::get('/get/blog/{id}', [BlogController::class, 'getBlog']);
Route::get('/about-us', [UserPageController::class, 'aboutUs'])->name('about');
Route::get('/testimonials', [UserPageController::class, 'testimonials'])->name('testimonials');
Route::get('/media-buying', [UserPageController::class, 'mediaBuying'])->name('media.buying');
Route::get('/category', [UserPageController::class, 'category'])->name('category');
Route::view('/career', 'user.components.career');
Route::view('/gallery', 'user.components.gallery');
Route::view('/team', 'user.components.team');
Route::view('/faq', 'user.components.faq');
Route::view('/casestudy/details', 'user.components.caseStudyDetails');
Route::get('desktop/casestudy/details', [CaseStudyController::class, 'desktopMoreCaseStudy']);
Route::view('/mobile/blog/details', 'user.components.mobileBlogDetails');

// Route::post("send-mail", [StartProjectController::class, "store"]);

Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware(['guest:admin', 'preventBackHistory'])->group(function () {
        Route::get('/login', [AdminController::class, 'login'])->name('login');
        Route::post('/login/check', [AdminController::class, 'check']);
        // Route::get('/signup', [AdminController::class, 'signup'])->name('signup');
        // Route::post('/signup/store', [AdminController::class, 'store'])->name('signup.store');
    });
    Route::middleware(['auth:admin', 'preventBackHistory'])->group(function () {

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        //home routes
        Route::get('/home', [HomeApiController::class, 'view_home'])->name('home');
        Route::get('/home/get', [HomeApiController::class, 'index']);
        Route::post('/home/store', [HomeApiController::class, 'store'])->name('home.store');
        Route::get('/home/edit/{id}', [HomeApiController::class, 'edit']);
        Route::post('/home/update/', [HomeApiController::class, 'update']);
        Route::get('/home/delete/{id}', [HomeApiController::class, 'destroy']);
        // case study route
        Route::get('/case-study', [CaseStudyController::class, 'show'])->name('casestudy');
        Route::get('/case-study/get', [CaseStudyController::class, 'index']);
        Route::post('/case-study/store', [CaseStudyController::class, 'store'])->name('case-study.store');
        Route::get('/case-study/edit/{id}', [CaseStudyController::class, 'edit']);
        Route::post('/case-study/update/', [CaseStudyController::class, 'update']);
        Route::get('/case-study/delete/{id}', [CaseStudyController::class, 'destroy']);

        Route::get('/case-study-desktop', [CaseStudyDesktopController::class, 'show'])->name('casestudydesktop');
        Route::get('/case-study-desktop/get', [CaseStudyDesktopController::class, 'index']);
        Route::post('/case-study-desktop/store', [CaseStudyDesktopController::class, 'store'])->name('case-study-desktop.store');
        Route::get('/case-study-desktop/edit/{id}', [CaseStudyDesktopController::class, 'edit']);
        Route::post('/case-study-desktop/update/', [CaseStudyDesktopController::class, 'update']);
        Route::get('/case-study-desktop/delete/{id}', [CaseStudyDesktopController::class, 'destroy']);

        //blogs route
        Route::get('/blog', [BlogController::class, 'index'])->name('blog');
        Route::get('/blog/get', [BlogController::class, 'fetchBlog'])->name('blog.get');
        Route::post('/blog/store', [BlogController::class, 'store'])->name('blog.store');
        Route::get('/blog/edit/{id}', [BlogController::class, 'edit']);
        Route::post('/blog/update/', [BlogController::class, 'update']);
        Route::get('/blog/delete/{id}', [BlogController::class, 'destroy']);

        Route::get('/service', [ServiceController::class, 'index'])->name('service');
        Route::get('/service/get', [ServiceController::class, 'showAll'])->name('service.get');
        Route::post('/service/store', [ServiceController::class, 'store'])->name('service.store');
        Route::get('/service/edit/{id}', [ServiceController::class, 'edit']);
        Route::post('/service/update/', [ServiceController::class, 'update']);
        Route::get('/service/delete/{id}', [ServiceController::class, 'destroy']);

        Route::get('/service-desktop', [ServiceDesktopController::class, 'index'])->name('service-desktop');
        Route::get('/service-desktop/get', [ServiceDesktopController::class, 'showAll'])->name('service-desktop.get');
        Route::post('/service-desktop/store', [ServiceDesktopController::class, 'store'])->name('service-desktop.store');
        Route::get('/service-desktop/edit/{id}', [ServiceDesktopController::class, 'edit']);
        Route::post('/service-desktop/update/', [ServiceDesktopController::class, 'update']);
        Route::get('/service-desktop/delete/{id}', [ServiceDesktopController::class, 'destroy']);

        Route::get('/client-speak', [ClientSpeakController::class, 'index'])->name('client-speak');
        Route::get('/client-speak/get', [ClientSpeakController::class, 'showAll'])->name('client-speak.get');
        Route::post('/client-speak/store', [ClientSpeakController::class, 'store'])->name('client-speak.store');
        Route::get('/client-speak/edit/{id}', [ClientSpeakController::class, 'edit']);
        Route::post('/client-speak/update/', [ClientSpeakController::class, 'update']);
        Route::get('/client-speak/delete/{id}', [ClientSpeakController::class, 'destroy']);

        Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us');
        Route::get('/about-us/get', [AboutUsController::class, 'showAll'])->name('about-us.get');
        Route::post('/about-us/store', [AboutUsController::class, 'store'])->name('about-us.store');
        Route::get('/about-us/edit/{id}', [AboutUsController::class, 'edit']);
        Route::post('/about-us/update/', [AboutUsController::class, 'update']);
        Route::get('/about-us/delete/{id}', [AboutUsController::class, 'destroy']);

        Route::get('/clients', [Clients::class, 'client_page_view'])->name('create-clients');
        Route::get('/clients/get', [Clients::class, 'index'])->name('clients.get');
        Route::post('/clients/store', [Clients::class, 'store'])->name('clients.store');
        Route::get('/clients/edit/{id}', [Clients::class, 'edit']);
        Route::post('/clients/update/', [Clients::class, 'update']);
        Route::get('/clients/delete/{id}', [Clients::class, 'destroy']);

        Route::get('/gallery', [GalleryController::class, 'index'])->name('create.gallery');
        Route::get('/gallery/get', [GalleryController::class, 'showAll'])->name('gallery.get');
        Route::post('/gallery/store', [GalleryController::class, 'store'])->name('gallery.store');
        Route::get('/gallery/edit/{id}', [GalleryController::class, 'edit']);
        Route::post('/gallery/update/', [GalleryController::class, 'update']);
        Route::post('/gallery/update-image', [GalleryController::class, 'update_image']);
        Route::get('/gallery/delete/{id}', [GalleryController::class, 'destroy']);
        Route::get('/gallery/delete-image/{id}', [GalleryController::class, 'destroy_image']);

        // Route::post('/mail', [StartProjectController::class, "store"]);

        Route::get('/current', [AdminController::class, 'logged_admin']);

        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    });
});
