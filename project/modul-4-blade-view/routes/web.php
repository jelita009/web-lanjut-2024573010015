<?php

use App\Http\Controllers\DasarBladeController;
use App\Http\Controllers\LogicController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Constraint\LogicalOr;

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
Route::get('/dasar', [DasarBladeController::class, 'showData']);
Route::get('/logic', [LogicController::class, 'show']);
Route::get('/admin', [PageController::class, 'admin']);
Route::get('/user', [PageController::class, 'user']);
Route::get('/', function () {
    return view('welcome');
});
