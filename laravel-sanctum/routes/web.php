<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\Auth\Socialite\authController;

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

Route::get('login/{provider}', [authController::class, 'redirect']);
Route::get('login/{provider}/callback', [authController::class, 'Callback']);

Route::get('/', function () {
    return view('welcome');
});
