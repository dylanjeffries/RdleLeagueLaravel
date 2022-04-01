<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\SubmitWordleController;
use App\Http\Controllers\SubmitNerdleController;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/', [AppController::class, 'show']);
Route::post('/signup', [AppController::class, 'signup']);
Route::post('/login', [AppController::class, 'login']);
Route::post('/logout', [AppController::class, 'logout']);

Route::get('/submitwordle', [SubmitWordleController::class, 'show']);
Route::post('/submitwordle', [SubmitWordleController::class, 'update']);
Route::get('/submitnerdle', [SubmitNerdleController::class, 'show']);
Route::post('/submitnerdle', [SubmitNerdleController::class, 'update']);