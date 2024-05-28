<?php

use App\Helpers\GeneralHelper;
use App\Http\Controllers\admin\CurrencyController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Role;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ViewsController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\Admin\PropertyController;

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
// Route::get('test', function () {
//     $no = GeneralHelper::GENERATE_APPLICATION_NUMBER();
//     dd($no);
// });

Route::get('/', [PropertiesController::class, 'index'])->name('index');
Route::get('about-us', [ViewsController::class, 'aboutUs'])->name('about-us');
Route::get('contact-us', [ViewsController::class, 'contactUs'])->name('contact-us');
Route::get('services', [ViewsController::class, 'services'])->name('services');
Route::get('property-listings/{type}', [ViewsController::class, 'rooms'])->name('rooms');
Route::get('room-details/{id}', [ViewsController::class, 'roomDetails'])->name('room.details');
Route::get('blog', [ViewsController::class, 'blog'])->name('blog');
Route::get('blog-details', [ViewsController::class, 'blogDetails'])->name('blog-details');
// Route::get('booking',[BookingController::class,'index'])->name('booking');
Route::get('property-bookings/{id}', [BookingController::class, 'getBookings'])->name('property.bookings');

Route::post('booking', [BookingController::class, 'saveBooking'])->name('booking.store');

Route::get('properties-filter', [PropertiesController::class, 'getProperties'])->name('properties.filter');
Route::post('owner-login', [OwnerController::class, 'login'])->name('ownerlogin');
Route::get('owner/login', [OwnerController::class, 'loginPage'])->name('owner.login');
Route::get('admin-dashboard', [OwnerController::class, 'adminDashboard'])->name('admin.dashboard');
Route::get('owner-dashboard', [OwnerController::class, 'ownerDashboard'])->name('owner.dashboard');

// Route::get('owner/properties',[PropertiesController::class,'getOwnerProperties'])->name('owner.properties');


Route::get('all-properties', [PropertyController::class, 'index'])->name('properties');
Route::get('create-property', [PropertyController::class, 'create'])->name('properties.create');

Route::post('add-property', [PropertyController::class, 'saveProperty'])->name('property.save');
Route::post('property-amenities', [PropertyController::class, 'savePropertyAmenities'])->name('property.amenities');
// Route::get('add-amenities', [PropertyController::class, 'addAmnities'])->name('amenities.add');
Route::post('add-amenities', [PropertyController::class, 'saveAmenities'])->name('amenities.save');
Route::get('edit-amenities/{id}', [PropertyController::class, 'editAmenities'])->name('amenities.edit');
Route::get('amenities', [PropertyController::class, 'getAmenities'])->name('amenities');
Route::get('delete-amenities/{id}', [PropertyController::class, 'deleteAmenities'])->name('amenities.delete');
Route::post('property-images', [PropertyController::class, 'savePropertyImages'])->name('property.images');
Route::get('get-fee', [PropertyController::class, 'getFee'])->name('get.fee');
Route::post('submit-application', [PropertyController::class, 'submitApplication'])->name('submit.application');
Route::get('currency', [CurrencyController::class, 'index'])->name('currency');
Route::get('find-property',[PropertiesController::class,'findProperty'])->name('find.property');
Route::post('save-currency', [CurrencyController::class, 'save'])->name('currency.save');

// Route::delete()