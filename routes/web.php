<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::middleware(['public'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/pomodoro', [App\Http\Controllers\ToolsCont\PomodoroController::class, 'index'])->name('pomodoro');   
});

// Auth needed
Route::get('/flashcards', [App\Http\Controllers\ToolsCont\FlashcardsController::class, 'index'])->name('flashcards');

Route::post('/flashcards/add-category-submit', [App\Http\Controllers\ToolsCont\FlashcardsController::class, 'addCategorySubmit'])->name('createCategorySubmit');
Route::post('/flashcards/add-set-submit', [App\Http\Controllers\ToolsCont\FlashcardsController::class, 'addSetSubmit'])->name('createSetSubmit');


Route::get('/flashcards/{flashcard}', [App\Http\Controllers\ToolsCont\FlashcardsController::class, 'show'])->name('flashcards.show');

Route::post('/flashcards/add-card-submit', [App\Http\Controllers\ToolsCont\FlashcardsController::class, 'addCardSubmit'])->name('createCardSubmit');
