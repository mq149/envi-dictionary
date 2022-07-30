<?php

use Illuminate\Support\Facades\App;
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

Route::get('/dictionary', function () {
    return view('dictionary');
})->name('dictionary');

Route::view('/{any}', 'dictionary')
    ->where('any', '.*');

Route::get('/set-locale/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'vi'])) {
        abort(400);
    }
    App::setLocale($locale);
});
