<?php

use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PropertiesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewsController;
use Spatie\Permission\Contracts\Role;

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

Route::get('/',[ViewsController::class, 'index'])->name('index');
Route::get('about-us',[ViewsController::class, 'aboutUs'])->name('about-us');
Route::get('contact-us',[ViewsController::class, 'contactUs'])->name('contact-us');
Route::get('services',[ViewsController::class, 'services'])->name('services');
Route::get('property-listings/{type}',[ViewsController::class, 'rooms'])->name('rooms');
Route::get('room-details/{id}',[ViewsController::class, 'roomDetails'])->name('room.details');
Route::get('blog',[ViewsController::class, 'blog'])->name('blog');
Route::get('blog-details',[ViewsController::class, 'blogDetails'])->name('blog-details');
// Route::get('booking',[BookingController::class,'index'])->name('booking');
Route::get('property-bookings/{id}',[BookingController::class,'getBookings'])->name('property.bookings');

Route::post('booking',[BookingController::class,'saveBooking'])->name('booking.store');

Route::get('properties-filter',[PropertiesController::class,'getProperties'])->name('properties.filter');
Route::post('owner-login',[OwnerController::class,'login'])->name('ownerlogin');
Route::get('owner/login',[OwnerController::class,'loginPage'])->name('owner.login');
Route::get('admin-dashboard',[OwnerController::class,'adminDashboard'])->name('admin.dashboard');
Route::get('owner-dashboard',[OwnerController::class,'ownerDashboard'])->name('owner.dashboard');

// Route::get('owner/properties',[PropertiesController::class,'getOwnerProperties'])->name('owner.properties');


Route::get('all-properties', [PropertyController::class, 'index'])->name('properties');
Route::post('add-property', [PropertyController::class, 'saveProperty'])->name('property.save');

// Route::get('add-amenities', [PropertyController::class, 'addAmnities'])->name('amenities.add');
Route::post('add-amenities', [PropertyController::class, 'saveAmenities'])->name('amenities.save');
Route::get('edit-amenities/{id}', [PropertyController::class, 'editAmenities'])->name('amenities.edit');
Route::get('amenities', [PropertyController::class, 'getAmenities'])->name('amenities');
