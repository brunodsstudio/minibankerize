<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProposalController;
#use App\Http\Controllers\Web\UserController as WebUserController;
#use App\Http\Controllers\API\UserController;

// Add single page app API routes

Route::post('/proposals', [ProposalController::class, 'store']);



Route::post('/greeting', function () {
    return 'Hello World hjdsgfj';
});

/*
Route::prefix("web")
    ->group(function () {
        Route::prefix("/user")->group(function () {
            Route::post("/register", [WebUserController::class, "register"]);
            Route::post("/", [WebUserController::class, "login"]);
            Route::delete(
                "/logout",
                [WebUserController::class, "logout"],
            )->middleware("auth:sanctum");
            Route::get(
                "/authorize",
                [WebUserController::class, "authorizeUser"],
            )->middleware("auth:sanctum");
        });
        Route::get(
            "/users",
            [WebUserController::class, "getUsers"],
        )->middleware("auth:sanctum");
    });
// Add third-party API routes
Route::prefix("/user")->group(function () {
    Route::post("/register", [UserController::class, "register"]);
    Route::post("/", [UserController::class, "login"]);
    Route::delete(
        "/logout",
        [UserController::class, "logout"],
    )->middleware("auth:sanctum");
    Route::get(
        "/authorize",
        [UserController::class, "authorizeUser"],
    )->middleware("auth:sanctum");
});
*/