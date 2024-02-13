<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;

use App\Http\Controllers\Admin\MenuController;

// Route to fetch all menus
Route::get('/api/menus', [MenuController::class, 'getAllMenus']);

// Route to create a new menu
Route::post('/admin/menus/create', [MenuController::class, 'store']);

// Route to fetch a specific menu for editing
Route::get('/admin/menus/{menu}', [MenuController::class, 'edit']);

// Route to update an existing menu
Route::put('/admin/menus/{menu}', [MenuController::class, 'update']);

// Route to delete a menu
Route::delete('/admin/menus/{menu}', [MenuController::class, 'destroy']);


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


// Route::post('/api/admin/categories/create', 'CategoryController@store')->name('api.admin.categories.store');


Route::post('/admin/login', 'AdminAuthController@login')->middleware('api');
// ... other routes
