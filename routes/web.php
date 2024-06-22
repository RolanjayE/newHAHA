<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FacilitiesController;
use App\Http\Controllers\Users\VisitorsController;

use App\Http\Controllers\Admin\CategoryController;

Route::get('/', function () {
    return view('welcome');
})->name("home");

Route::get('visitors/shop', [VisitorsController::class, 'index'])->name('visitor.shop');
Route::get('/visitors/shop/view/{id}', [VisitorsController::class, 'show'])->name('VisitorsController.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // category
    Route::get('/admin/category', [CategoryController::class, 'index'])->name('category.view');
    Route::post('/admin/category', [CategoryController::class, 'store'])->name('category.store');
    Route::post('/admin/category/deleted/id/list', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::post('/admin/category/update', [CategoryController::class, 'update'])->name('category.update');



    // facilities
    Route::get('/admin/facilities', [FacilitiesController::class, 'index'])->name('facilities.view');
    Route::post('/admin/facilities', [FacilitiesController::class, 'store'])->name('facilities.store');
    Route::get('/admin/facilities/edit/{id}', [FacilitiesController::class, 'edit'])->name('facilities.edit');
    Route::post('/admin/facilities/update/{id}', [FacilitiesController::class, 'update'])->name('facilities.update');
});

require __DIR__.'/auth.php';
