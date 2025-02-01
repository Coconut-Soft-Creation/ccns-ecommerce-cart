<?php

use Illuminate\Support\Facades\Route;

Route::prefix('api/cart')->group(function () {})->middleware(['auth:api']);
