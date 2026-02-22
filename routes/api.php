<?php

use App\Http\Controllers\API\TteController;
use App\Http\Middleware\API\BasicMiddleware;
use App\Http\Middleware\BasicuserMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/coba', function () {
    return response()->json(['id' => 0]);
});

Route::controller(TteController::class)->group(function () {
    Route::post("/v2/sign/pdf", 'index')->middleware(BasicMiddleware::class);
    Route::post("/v3/sign/pdf", 'tte')->middleware(BasicuserMiddleware::class);
});
