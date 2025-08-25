<?php

use App\Http\Controllers\BoxController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [BoxController::class, 'index']);
Route::get('/run-scheduler', [BoxController::class, 'runScheduler'])->name('run.scheduler');

