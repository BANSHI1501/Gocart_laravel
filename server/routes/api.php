<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

Route::post('/user/register', [AuthController::class, 'register']);
Route::post('/user/login', [AuthController::class, 'login']);
Route::post('/seller/login', [AuthController::class, 'sellerLogin']);

Route::get('/product/list', [ProductController::class, 'productList']);
Route::get('/product/{id}', [ProductController::class, 'getProductById']);

Route::middleware('auth:api')->group(function () {
    Route::get('/user/me', [AuthController::class, 'me']);
    Route::delete('/user/logout', [AuthController::class, 'logout']);
    Route::get('/seller/me', [AuthController::class, 'me']);
    Route::post('/seller/logout', [AuthController::class, 'logout']);

    Route::post('/product/add', [ProductController::class, 'addProduct']);
    Route::patch('/product/{id}', [ProductController::class, 'changeStock']);
    Route::delete('/product/{id}', [ProductController::class, 'deleteProduct']);

    Route::post('/address/add', [AddressController::class, 'addAddress']);
    Route::get('/address/get', [AddressController::class, 'getAddress']);

    Route::patch('/cart/update', [CartController::class, 'updateCart']);

    Route::post('/order/cod', [OrderController::class, 'placeOrderCOD']);
    Route::post('/order/razorpay', [OrderController::class, 'placeOrderRazorpay']);
    Route::post('/order/verifyRazorpay', [OrderController::class, 'verifyRazorpay']);
    Route::get('/order/user', [OrderController::class, 'getUserOrders']);
    Route::get('/order/seller', [OrderController::class, 'getAllOrders']);
    Route::delete('/order/{orderId}', [OrderController::class, 'deleteOrderById']);
    Route::patch('/order/{orderId}', [OrderController::class, 'changeOrderStatus']);
});
