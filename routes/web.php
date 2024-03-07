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
Route::get('/', static function () {
//    return view('welcome');
    return redirect()->route('platform.main');
});
//Route::post('/admin/examples/filter/buttonClickTest', function (Request $request) {
//    dd($request);
//    return view('welcome');
//})->name('buttonClickTest');
