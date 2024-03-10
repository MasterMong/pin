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

Route::get('/web', [\App\Http\Controllers\WebpageController::class, 'index'])->name('index');
Route::get('/logmeout', function () {
    Session::flush();
    Auth::logout();
//    return redirect()->route('index');
    return redirect()->to('/');
})->name('logmeout');
//if (env('APP_ENV') === 'production') {
//    URL::forceScheme('https');
//}
