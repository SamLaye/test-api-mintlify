<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/blog', function (\Illuminate\Http\Request $request) {
    return [
        "name" => $request->input('age', 25),
        "Articles" => "My articles"
    ];
});

Route::get('/blog/{slug}-{id}', function (string $slug, string $id) {
    return [
        "id" => $id,
        "slug" => $slug,
        // "name" => $request->input('name'),
    ];
});