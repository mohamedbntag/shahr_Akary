<?php

use App\Http\Controllers\Search_editorsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestimonialsController;
use App\Http\Controllers\EditorsController;
use App\Http\Controllers\CityController;

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

Route::get('/welcome', function () {
    //$pdf = PDF::loadView('welcome');
    //return $pdf->download('welcome.pdf');
    return view('welcome');
})->name('welcome');

Route::get('/',function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/testimonials', [TestimonialsController::class, 'index'])->name('testimonials.index');
Route::post('/testimonials', [TestimonialsController::class, 'store'])->name('testimonials.store');
/*------print testimonials editors end Page-------------*/
//Route::get('/testimonials/pdf/{id}', [TestimonialsController::class, 'pdf'])->name('testimonials.pdf');
Route::get('/testimonials/printPage/{id}', [TestimonialsController::class, 'printPage'])->name('testimonials.printPage');
/*------print testimonials editors end Page-------------*/

/*====================
=start print print_search_editors
=======================*/
Route::get('/testimonials/print_search_editors/{id}', [TestimonialsController::class, 'print_search_editors'])->name('testimonials.print_search_editors');
/*====================
=End print print_search_editors
=======================*/

//Route::get('/testimonials/{id}', [TestimonialsController::class, 'show'])->name('testimonials.show');
Route::delete('/testimonials/{id}', [TestimonialsController::class, 'destroy'])->name('testimonials.delete');

/* ----------------
---start route editors controller
---------------*/
Route::post('/editors', [EditorsController::class, 'store'])->name('editors.store');

Route::delete('/editors/{id}', [EditorsController::class, 'destroy'])->name('editors.destroy');

/* ----------------End route editors controller---------------*/
/* ----------------
---start route search_editors controller
---------------*/
Route::post('/search_editors', [search_editorsController::class, 'store'])->name('search_editors.store');

Route::get('/search_editors/{id}/edit', [search_editorsController::class, 'edit'])->name('search_editors.edit');

Route::put('/search_editors/{id}', [search_editorsController::class, 'update'])->name('search_editors.update');

Route::delete('/search_editors/{id}', [search_editorsController::class, 'destroy'])->name('search_editors.destroy');
/* ----------------End route search_editors controller---------------*/

/* ----------------
---start route create new city
---------------*/
Route::get('/form_city', [CityController::class, 'index'])->name('form_city.index');

Route::post('/form_city/side', [CityController::class, 'store_side'])->name('form_city_side.store');

Route::post('/form_city/section', [CityController::class, 'store_section'])->name('form_city_section.store');

/* ----------------
---end route create new city
---------------*/
