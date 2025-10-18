<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoriaController;
use App\Http\Controllers\Api\ProductoController;

/*
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
*/
//DECLARAR LAS RUTAS DE CATEGORIAS
//Route::apiResource('ctaegorias'),CategoriaController::class

Route::get('/consultar-todas-categoria',[CategoriaController::class, 'index']);
Route::get('/consultar-categoria/{categoria}',[CategoriaController::class, 'show']);
Route::post('/guardar-categoria',[CategoriaController::class, 'store']);
Route::put('/actualizar-categoria/{categoria}',[CategoriaController::class, 'update']);
Route::delete('/eliminar-categoria/{categoria}',[CategoriaController::class, 'destroy']);
//DECLARAR LAS RUTAS DE PRODUCTOS

Route::get('/consultar-todas-producto',[ProductoController::class, 'index']);
Route::get('/consultar-producto/{producto}',[ProductoController::class, 'show']);
Route::post('/guardar-producto',[ProductoController::class, 'store']);
Route::put('/actualizar-producto/{producto}',[ProductoController::class, 'update']);
Route::delete('/eliminar-producto/{producto}',[ProductoController::class, 'destroy']);