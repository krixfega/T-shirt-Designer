<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TShirtController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Auth::routes();

Route::get('/customization', [TShirtController::class, 'showCustomizationPage']);
Route::post('/customize', [TShirtController::class, 'customizeTShirt']);
Route::get('/customization/details/{id}', [TShirtController::class, 'showCustomizationDetails'])
    ->name('customization.details');
