<?php

use App\Http\Controllers\APIController;
use Illuminate\Support\Facades\Route;

Route::get('{category}', [APIController::class, 'category'])
    ->name('api.category');
