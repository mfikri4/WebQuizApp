<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\TestController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\User;

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

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => 'admin'],function(){

    // Route::get('/home', [AdminController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::prefix('quiz')->group(function(){
        Route::get('/', [QuizController::class, 'index']);
        Route::get('create', [QuizController::class, 'create']);
        Route::post('create', [QuizController::class, 'insert']);
        Route::get('edit/{id}', [QuizController::class, 'edit']);
        Route::post('edit/{id}', [QuizController::class, 'update']);
        Route::get('delete/{id}', [QuizController::class, 'delete']);
    });
    Route::prefix('question')->group(function(){
        Route::get('/{id}', [QuestionController::class, 'index']);
        Route::post('create', [QuestionController::class, 'insert']);
        Route::get('delete/{id}', [QuestionController::class, 'delete']);
    });


    Route::get('result', [ResultController::class, 'result']);
   
});

Route::group(['middleware' => 'user'],function(){

    Route::get('dashboard', [AdminController::class, 'dashboard']);
    
    Route::prefix('test')->group(function(){
        Route::get('/', [TestController::class, 'index']);
        Route::get('start/{id}', [TestController::class, 'start_quiz']);
        Route::post('score', [TestController::class, 'store']);
    });

    Route::get('result-user', [ResultController::class, 'index']);
   
    
});