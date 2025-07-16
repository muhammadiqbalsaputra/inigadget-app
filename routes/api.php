<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ProductController;

Route::apiResource('/products', ProductController::class)->only([
    'index',
    'store',
    'show',
    'update',
    'destroy'
]);

// Route::apiResource('/product-categories', ProductCategoryController::class)->only([
//     'index',
//     'store',
//     'show',
//     'update',
//     'destroy'
// ]);