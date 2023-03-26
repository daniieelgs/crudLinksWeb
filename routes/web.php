<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\WebControllerApi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('index', ['username' => Auth::check() ? Auth::user() : null]);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('web', [WebController::class, 'addWeb']);
    Route::put('web/{id}', [WebController::class, 'updateWeb'])->where(['id' => '[0-9]+']);
    Route::delete('web/{id}', [WebController::class, 'deleteWeb'])->where(['id' => '[0-9]+']);
    Route::get('web/{id}/edit', [WebController::class, 'editWeb'])->where(['id' => '[0-9]+']);
    Route::get('web/create', [WebController::class, 'createWeb']);


});

Route::get('web', [WebController::class, 'seeAll']);
Route::get('web/{id}', [WebController::class, 'seeWeb'])->where(['id' => '[0-9]+']);

Route::group(['prefix' => 'api'], function () {

    Route::get('readAllNames', [WebControllerApi::class, 'readAllNames']);

});

require __DIR__.'/auth.php';
