<?php

use App\Http\Controllers\API\TteController;
use App\Http\Middleware\API\BasicMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/coba', function () {
    return response()->json(['id' => 0]);
});

Route::controller(TteController::class)->group(function () {
    Route::get("/v2/sign/pdf", 'index')->middleware(BasicMiddleware::class);
});
