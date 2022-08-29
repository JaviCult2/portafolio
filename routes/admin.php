<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\VueController;
use App\Http\Controllers\Admin\ProjectController;

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

Route::get('/app/{any}', [VueController::class, 'render'])
    ->where('any', '.*')
    ->name('admin.vue');

//Project

Route::get('admin/app/index', [ProjectController::class, 'index'])
    ->name('admin_project_index')
    ->middleware("auth.admin");

Route::post('admin/app/create', [ProjectController::class, 'create'])
    ->name('admin_project_create')
    ->middleware("auth.admin");

Route::post('admin/app/update', [ProjectController::class, 'update'])
    ->name('admin_project_update')
    ->middleware("auth.admin");

Route::post('admin/app/delete/{id}', [ProjectController::class, 'delete'])
    ->name('admin_project_delete')
    ->middleware("auth.admin");

Route::get('admin/app/active/{id}', [ProjectController::class, 'active'])
    ->name('admin_project_active')
    ->middleware("auth.admin");
