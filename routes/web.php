<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewsController;

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
    return view('user.index');
})->name('index');

Route::get('about-us',[ViewsController::class, 'aboutUs'])->name('about-us');
Route::get('contact-us',[ViewsController::class, 'contactUs'])->name('contact-us');
Route::get('services',[ViewsController::class, 'services'])->name('services');
Route::get('rooms',[ViewsController::class, 'rooms'])->name('rooms');
Route::get('room-details',[ViewsController::class, 'roomDetails'])->name('room-details');
Route::get('blog',[ViewsController::class, 'blog'])->name('blog');
Route::get('blog-details',[ViewsController::class, 'blogDetails'])->name('blog-details');


