<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\VueController;
use App\Http\Controllers\Web\ProjectController;

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
    ->name('web.vue');

//Projects

Route::get('web/app/index', [ProjectController::class, 'index'])
    ->name('web_project_index');
