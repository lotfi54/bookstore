<?php
use App\Http\Controllers\Api\AuteurController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\LivreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('auteur', AuteurController::class);
Route::resource('genre', GenreController::class);
Route::resource('livre', LivreController::class);

