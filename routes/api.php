<?php

use app\Http\Controllers\Api\BookController;
use Illuminate\Support\Facades\Route;


Route::apiResource('books', BookController::class);
