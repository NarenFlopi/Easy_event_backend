<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('storage/{folder}/{filename}', function ($folder,$filename)
{
    //return response()->json($filename);
    return Image::make(storage_path('app/public/' .$folder.'/'. $filename))->response();
});