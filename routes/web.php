<?php

use App\Http\Controllers\BoxController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// routes/web.php
// Route::get('/', fn() => view('app'));

Route::get('/box', [BoxController::class, 'index']);
// Route::get('/run-scheduler', [BoxController::class, 'runScheduler'])->name('run.scheduler');

