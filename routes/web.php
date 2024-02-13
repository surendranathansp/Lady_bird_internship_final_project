<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Frontend\WelcomeController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Frontend\MenuController as FrontendMenuController;
use App\Http\Controllers\Frontend\CategoryController as FrontendCategoryController;
use App\Http\Controllers\Frontend\ReservationController as FrontendReservationController;
use App\Http\Controllers\Admin\CategoryViewController;



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/', [WelcomeController::class, 'index']);
Route::get('/thankyou', [WelcomeController::class, 'thankyou'])->name('thankyou');

#API
Route::name('api.')->prefix('api')->group(function () {
    # Categories
    Route::get('/categories/list', [CategoryViewController::class, 'getAllList'])->name('category.list');
    Route::get('/categories/details/{id}', [CategoryViewController::class, 'getDetails'])->name('category.details');

    #menus
    Route::get('/menus/list', [MenuController::class, 'getAllList'])->name('menu.list');
    Route::get('/menus/details/{id}', [MenuController::class, 'getDetails'])->name('menu.details');

    #table
    Route::get('/table/list', [TableController::class, 'getAllList'])->name('table.list');
    Route::get('/table/details/{id}', [TableController::class, 'getDetails'])->name('table.details');

    #table
    Route::get('/reservations/list', [ReservationController::class, 'getAllList'])->name('reservations.list');
    Route::get('/reservations/details/{id}', [ReservationController::class, 'getDetails'])->name('reservations.details');
});
#categories
Route::get('/admin/categories', [CategoryViewController::class, 'index'])->name('admin.categories.index');
Route::get('/admin/categories/create', [CategoryViewController::class, 'create'])->name('admin.categories.create');
Route::post('/admin/categories/store', [CategoryViewController::class, 'store'])->name('admin.categories.store');
Route::get('/admin/categories/edit/{id}', [CategoryViewController::class, 'edit'])->name('admin.categories.edit');
Route::put('/admin/categories/update/{id}', [CategoryViewController::class, 'update'])->name('admin.categories.update');
Route::delete('/admin/categories/delete/{id}', [CategoryViewController::class, 'destroy'])->name('admin.categories.destroy');

#Menu
Route::get('/admin/menus', [MenuController::class, 'index'])->name('admin.menus.index');
Route::get('/admin/menus/create', [MenuController::class, 'create'])->name('admin.menus.create');
Route::post('/admin/menus/store', [MenuController::class, 'store'])->name('admin.menus.store');
Route::get('/admin/menus/edit/{id}', [MenuController::class, 'edit'])->name('admin.menus.edit');
Route::put('/admin/menus/update/{id}', [MenuController::class, 'update'])->name('admin.menus.update');
Route::delete('/admin/menus/delete/{id}', [MenuController::class, 'destroy'])->name('admin.menus.destroy');

#table
Route::get('/admin/table', [TableController::class, 'index'])->name('admin.table.index');
Route::get('/admin/table/create', [TableController::class, 'create'])->name('admin.table.create');
Route::post('/admin/table/store', [TableController::class, 'store'])->name('admin.table.store');
Route::get('/admin/table/edit/{id}', [TableController::class, 'edit'])->name('admin.table.edit');
Route::put('/admin/table/update/{id}', [TableController::class, 'update'])->name('admin.table.update');
Route::delete('/admin/table/delete/{id}', [TableController::class, 'destroy'])->name('admin.table.destroy');


#table
Route::get('/admin/reservations', [ReservationController::class, 'index'])->name('admin.reservations.index');
Route::delete('/admin/reservations/delete/{id}', [ReservationController::class, 'destroy'])->name('admin.reservations.destroy');

# frontEnd routes
Route::name('web-api.')->prefix('web-api')->group(function () {
    # Categories
    Route::get('/categories/list', [FrontendCategoryController::class, 'getAllList'])->name('category.list');
    Route::get('/categories/details/{id}', [FrontendCategoryController::class, 'getDetails'])->name('category.details');
    Route::get('/menus/list', [MenuController::class, 'getAllList'])->name('menus.allList');
        # Step One - Reservation
        Route::get('/reservation/step-one', [ReservationController::class, 'stepOne'])->name('reservation.step.one');
        Route::post('/reservation/store-step-one', [ReservationController::class, 'storeStepOne'])->name('reservation.store.step.one');
    
        # Step Two - Reservation
        Route::get('/reservation/step-two', [ReservationController::class, 'stepTwo'])->name('reservation.step.two');
        Route::post('/reservation/store-step-two', [ReservationController::class, 'storeStepTwo'])->name('reservation.store.step.two');
   
});

Route::get('/categories', [FrontendCategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/show/{id}', [FrontendCategoryController::class, 'show'])->name('categories.show');


Route::get('/menus', [FrontendMenuController::class, 'index'])->name('menus.index');
Route::get('/reservation/step-one', [FrontendReservationController::class, 'stepOne'])->name('reservations.step.one');
Route::post('/reservation/step-one', [FrontendReservationController::class, 'storeStepOne'])->name('reservations.store.step.one');
Route::get('/reservation/step-two', [FrontendReservationController::class, 'stepTwo'])->name('reservations.step.two');
Route::post('/reservation/step-two', [FrontendReservationController::class, 'storeStepTwo'])->name('reservations.store.step.two');






Route::middleware(['auth', 'admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
  
});
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);


require __DIR__ . '/auth.php';
