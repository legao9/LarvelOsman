<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
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

Route::apiResource('posts', App\Http\Controllers\CarController::class);

// Route::post('api/fetchYears', function (Request $request) {
//     $carId = $request->input('car_id');
//     $car = Car::find($carId);

//     if ($car) {
//         // Fetch years from the car model or any other logic
//         // $years = $car->getYears();
//         $years = [2,3,3,2,1];
//         return response()->json($years);
//     } else {
//         return response()->json(['error' => 'Invalid car ID'], Response::HTTP_BAD_REQUEST);
//     }
// })->name('api.fetchYears');

// Route::prefix('api')->group(function () {
//     Route::post('fetchYears', [ApiController::class, 'fetchYears']);
//     Route::get('fetchModels', [ApiController::class, 'fetchModels']);
//     Route::get('fetchPositions', [ApiController::class, 'fetchPositions']);
//     Route::get('fetchTechnologies', [ApiController::class, 'fetchTechnologies']);
//     Route::get('fetchPillars', [ApiController::class, 'fetchPillars']);
// });
