<?php
use Illuminate\Support\Facades\Route;
use Jackabox\DuplicateField\Http\Controllers\DuplicateController;

Route::post('/', DuplicateController::class . '@duplicate');
