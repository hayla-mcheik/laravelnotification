<?php


use App\Http\Controllers\AdminAuth;
use App\Http\Controllers\Ads;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerAuth;
use App\Http\Controllers\HomeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\CaseStudiesController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\VisitorsController;
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

Route::get('/login', [AdminAuth::class, 'loginpage'])->name('login');
Route::post('/admin/login', [AdminAuth::class, 'login'])->name('admin.login');
Route::post('/register', [CustomerAuth::class, 'register'])->name('customer.register');
Route::post('/admin/register', [AdminAuth::class, 'register'])->name('admin.register');


Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/', [AdminAuth::class, 'dashboard']);
    Route::get('/dashboard', [AdminAuth::class, 'dashboard'])->name('admin.dashboard');



    Route::get('/home/background', [HomeeController::class, 'home'])->name('admin.home.background');
    Route::post('/home/background/update', [HomeeController::class, 'homebackupdate'])->name('home.back.update');


    Route::get('/home/video', [HomeeController::class, 'homevideo'])->name('admin.home.video');
    Route::post('/home/video/update', [HomeeController::class, 'homevideoupdate'])->name('admin.home.video.update');


    Route::get('/home/animation/text', [HomeeController::class, 'homeanimationtext'])->name('admin.home.animationtext');
    Route::post('/home/animation/text', [HomeeController::class, 'homeanimationtextupdate'])->name('admin.home.animation.text');


    Route::get('/home/client', [HomeeController::class, 'client'])->name('admin.home.client');
    Route::post('/home/client/add', [HomeeController::class, 'addclient'])->name('admin.home.client.add');
    Route::post('/home/client/update/{id}', [HomeeController::class, 'updateclient'])->name('admin.home.client.update');
    Route::get('/home/client/delete/{id}', [HomeeController::class, 'deleteclient'])->name('admin.home.client.delete');


    Route::get('/home/testimonials', [HomeeController::class, 'testimonials'])->name('admin.home.testimonials');
    Route::post('/home/testimonials/add', [HomeeController::class, 'addtestimonials'])->name('admin.home.testimonials.add');
    Route::post('/home/testimonials/update/{id}', [HomeeController::class, 'updatetestimonials'])->name('admin.home.testimonials.update');
    Route::get('/home/testimonials/delete/{id}', [HomeeController::class, 'deletetestimonials'])->name('admin.home.testimonials.delete');


    Route::get('/category', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.home.project.category');
    Route::get('/category/create', [App\Http\Controllers\Admin\CategoryController::class, 'create']);
    Route::post('/category', [App\Http\Controllers\Admin\CategoryController::class, 'store']);


    Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function () {
        Route::get('/category', 'index')->name('admin.home.project.category');
        Route::get('/category/create', 'create');
        Route::post('/category', 'store');
        Route::get('/category/{category}/edit', 'edit');
        Route::put('/category/{category}', 'update');
        Route::get('/category/{category}', 'delete')->name('admin.home.category.delete');
    });

    Route::controller(App\Http\Controllers\Admin\ProductController::class)->group(function () {
        Route::get('/projects', 'index')->name('admin.home.projects');
        Route::get('/projects/create', 'create');
        Route::post('/projects', 'store')->name('admin.home.projects.create');
        Route::get('/projects/{project_id}/edit', 'edit');
        Route::put('/projects/{project_id}', 'update')->name('admin.home.projects.update');
        Route::get('/projects/{project_id}/delete', 'destroy');
        Route::post('/project-image/{project_image_id}/delete', 'destroyImage')->name('project.delete.image');
        Route::post('/project-image/sort', 'sortImages')->name('project.sortImages');



        Route::get('/projects/{project_id}/images', [ProductController::class, 'projectdetails']);
        Route::post('/projects/{project_id}/images/add', [ProductController::class, 'addprojectdetails'])->name('admin.projects.details.add');
        Route::post('/projects/{project_id}/images/update/{id}', [ProductController::class, 'updateprojectdetails'])->name('admin.projects.details.update');
        Route::get('/projects/{project_id}/images/delete/{id}', [ProductController::class, 'deleteprojectdetails'])->name('admin.projects.details.delete');


        // product details image

    });





    Route::get('/agency', [AgencyController::class, 'agency'])->name('admin.agency.agency');
    Route::post('/agency', [AgencyController::class, 'updateagency'])->name('admin.agency.agency.update');

    Route::get('/agency/images', [AgencyController::class, 'agencyimages'])->name('admin.agency.images');
    Route::post('/agency/images/update', [AgencyController::class, 'agencyimagesupdate'])->name('admin.agency.images.update');

    Route::get('/agency/members', [AgencyController::class, 'agencymembers'])->name('admin.agency.members');
    Route::post('/agency/members/add', [AgencyController::class, 'addagencymembers'])->name('admin.agency.members.add');
    Route::post('/agency/members/update/{id}', [AgencyController::class, 'updateagencymembers'])->name('admin.agency.members.update');
    Route::get('/agency/members/delete/{id}', [AgencyController::class, 'deleteagencymembers'])->name('admin.agency.members.delete');

    Route::get('/agency/slider', [AgencyController::class, 'agencyslider'])->name('admin.agency.slider');
    Route::post('/agency/slider/add', [AgencyController::class, 'addagencyslider'])->name('admin.agency.slider.add');
    Route::post('/agency/slider/update/{id}', [AgencyController::class, 'updateagencyslider'])->name('admin.agency.slider.update');
    Route::get('/agency/slider/delete/{id}', [AgencyController::class, 'deleteagencyslider'])->name('admin.agency.slider.delete');


    Route::get('/agency/banner', [AgencyController::class, 'agencybanner'])->name('admin.agency.banner');
    Route::post('/agency/banner', [AgencyController::class, 'updateagencybanner'])->name('admin.agency.banner.update');





    Route::get('/casestudies', [CaseStudiesController::class, 'index'])->name('admin.casestudies.index');
    Route::get('/casestudies/create', [CaseStudiesController::class, 'create']);
    Route::post('/casestudies', [CaseStudiesController::class, 'store']);
    Route::get('/casestudies/{studies}/edit', [CaseStudiesController::class, 'edit']);
    Route::put('/casestudies/{studies}', [CaseStudiesController::class, 'update']);
    Route::get('/casestudies/{studies_id}/delete', [CaseStudiesController::class, 'destroy']);
    Route::get('/studies-image/{studies_image_id}/delete', [CaseStudiesController::class, 'destroyImage']);


    Route::get('/casestudies/{studies_id}/images', [CaseStudiesController::class, 'casestudiesdetails']);
    Route::post('/casestudies/{studies_id}/images/add', [CaseStudiesController::class, 'addcasestudiesdetails'])->name('admin.casestudies.details.add');
    Route::post('/casestudies/{studies_id}/images/update/{id}', [CaseStudiesController::class, 'updatecasestudiesdetails'])->name('admin.casestudies.details.update');
    Route::get('/casestudies/{studies_id}/images/delete/{id}', [CaseStudiesController::class, 'deletecasestudiesdetails'])->name('admin.casestudies.details.delete');




    Route::get('/blogs', [BlogController::class, 'blog'])->name('admin.blog');
    Route::post('/blogs/add', [BlogController::class, 'addblog'])->name('admin.blog.add');
    Route::post('/blogs/update/{id}', [BlogController::class, 'updateblog'])->name('admin.blog.update');
    Route::get('/blogs/delete/{id}', [BlogController::class, 'deleteblog'])->name('admin.blog.delete');



    Route::controller(App\Http\Controllers\Admin\CategoryServiceController::class)->group(function () {
        Route::get('service/category', 'index')->name('admin.services.category');
        Route::get('service/category/create', 'create');
        Route::post('service/category', 'store');
        Route::get('service/category/{category}/edit', 'edit');
        Route::put('service/category/{category}', 'update');
        Route::get('service/category/{category}', 'delete')->name('admin.services.category.delete');
    });


    Route::controller(App\Http\Controllers\Admin\ServicesController::class)->group(function () {
        Route::get('services', 'index')->name('admin.services');
        Route::get('services/create', 'create');
        Route::post('services', 'store');
        Route::get('services/{service}/edit', 'edit');
        Route::put('services/{service}', 'update');
        Route::get('/services/{services_id}/delete', 'destroy');
        Route::get('services-image/{services_image_id}/delete', 'destroyImage');
    });






    Route::get('/about', [AboutController::class, 'about'])->name('admin.about');
    Route::post('/about/description/update', [AboutController::class, 'updateaboutdesc'])->name('admin.about.description.update');


    Route::get('/contact', [ContactController::class, 'contact'])->name('admin.contact');
    Route::post('/contact', [ContactController::class, 'updatecontact'])->name('admin.contact.update');

    Route::get('/logout', [AdminAuth::class, 'logout'])->name('admin.logout');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
