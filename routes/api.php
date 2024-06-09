<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AlquilerApiController;
use App\Http\Controllers\API\ProductoApiController;
use App\Http\Controllers\API\FavoritoApiController;
use App\Http\Controllers\API\CategoriaApiController;
use App\Http\Controllers\API\EmpresaApiController;
use App\Http\Controllers\API\SancionApiController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class,'login']);
    Route::post('signup', [AuthController::class,'signUp']);
    Route::post('signup_empresario', [AuthController::class,'signUpEmpresario']);
  

});

Route::group([
    'middleware' => 'auth:api'
  ], function() {
      Route::get('users', [AuthController::class, 'users']);
      Route::delete('user/{id}', [AuthController::class, 'delete']);
      Route::put('user/edit', [AuthController::class, 'update']);
      Route::apiResource('sancion', SancionApiController::class);
      Route::apiResource('producto', ProductoApiController::class);
      Route::get('getProductos/{id}',[ProductoApiController::class,'getProductosCategoria']);
      Route::post('producto/search', [ProductoApiController::class, 'search']);
      Route::post('producto/actualizar/{id}', [ProductoApiController::class, 'actualizar']);
      Route::apiResource('empresa', EmpresaApiController::class);
      Route::apiResource('categoria', CategoriaApiController::class);
      Route::apiResource('favorito', FavoritoApiController::class);
      Route::get('favoritos/user', [FavoritoApiController::class, 'listarfavoritos']);
      Route::apiResource('alquiler', AlquilerApiController::class);
      Route::get('alquileres/contar', [AlquilerApiController::class, 'contarAlquileres']);
      Route::post('alquiler/filtrar', [AlquilerApiController::class, 'filtrarAlquileres']);
      Route::post('alquileres/carrito', [AlquilerApiController::class, 'carrito']);
      Route::post('alquileres/delete_carrito', [AlquilerApiController::class, 'deletecarrito']);
      Route::get('logout', [AuthController::class, 'logout']);
      Route::get('autologin', [AuthController::class, 'autologin']);

      


      /*Route::delete('categoria/{id}', [CategoriaApiController::class, 'destroy']);
      Route::post('alquiler', [AlquilerApiController::class, 'show']);
      Route::post('alquiler/actualizar', [AlquilerApiController::class, 'update']);
      Route::post('alquiler/guardar', [AlquilerApiController::class, 'store']);
      Route::get('logout', [AuthController::class,'logout']);
      Route::get('user', [AuthController::class,'user']);
      Route::put('producto/{id}',[ProductoApiController::class, 'update']);
      Route::delete('producto/{id}', [ProductoApiController::class, 'destroy']);
      Route::post('/agregar-favorito/{producto}', [FavoritoApiController::class, 'agregarFavorito']);
      Route::post('/eliminar-favorito/{producto}', [FavoritoApiController::class, 'eliminarFavorito']);*/

      
  });




