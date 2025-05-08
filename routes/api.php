<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;




Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    //CRUD de productos
    Route::resource('productos', ProductoController::class);

    //(solo index, store y destroy)
    Route::get('categorias', [CategoriaController::class, 'index']);
    Route::post('categorias', [CategoriaController::class, 'store']);
    Route::delete('categorias/{id}', [CategoriaController::class, 'destroy']);
});


Route::get('categorias', [CategoriaController::class, 'index']);
