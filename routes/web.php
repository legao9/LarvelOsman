<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\CarController;


// use DB;
use App\Models\Car;
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

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/select',  [CarController::class, 'index'] );
    Route::get('/api/pillars', [ApiController::class, 'pillars'])->name('api.pillars.get');
    Route::post('/select/fetchYears', [CarController::class, 'fetchYears']);
    Route::post('/select/fetchModels', [CarController::class, 'fetchModels']);
    Route::post('/select/fetchPositions', [CarController::class, 'fetchPositions']);
    Route::post('/select/fetchTechnologies', [CarController::class, 'fetchTechnologies']);
    Route::post('/select/fetchPillars', [CarController::class, 'fetchPillars']);
    Route::post('/select/fetchType', [CarController::class, 'fetchType']);

    // Route::get('/test',  function () {    return 'HELLO'; });
