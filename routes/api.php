<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoxController;

Route::get('/boxes', [BoxController::class, 'index']);
