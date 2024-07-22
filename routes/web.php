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
use App\Http\Controllers\admin\RoomController;
use App\Http\Controllers\AmenityController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;

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
Route::get('rooms/{id}', [RoomController::class, 'rooms'])->name('rooms');
Route::post('create/room', [RoomController::class, 'create'])->name('room.create');
Route::post('addRoomsType', [RoomController::class, 'addRoomsType'])->name('addRoomsType');
Route::post('store-room', [RoomController::class, 'store'])->name('room.store');
Route::get('get-fee', [RoomController::class, 'getFee'])->name('get.fee');
Route::get('rooms/types/{id}', [RoomController::class, 'getRoomTypes'])->name('room.types');

Route::post('store-room-info', [RoomController::class, 'storeRoomInfo'])->name('room.info.store');
Route::post('submit-room-form', [RoomController::class, 'submitRoomForm'])->name('room.form.submit');
Route::get('blog', [ViewsController::class, 'blog'])->name('blog');
Route::get('blog-details', [ViewsController::class, 'blogDetails'])->name('blog-details');
// Route::get('booking',[BookingController::class,'index'])->name('booking');
Route::get('create/bookings/{id}', [BookingController::class, 'createBooking'])->name('create.booking');
// Route::get('booking/{id}', [BookingController::class, 'index'])->name('create.booking');
Route::post('booking', [BookingController::class, 'saveBooking'])->name('booking.store');

Route::get('properties-filter', [PropertiesController::class, 'getProperties'])->name('properties.filter');
Route::post('owner-login', [OwnerController::class, 'login'])->name('ownerlogin');
Route::get('owner/login', [OwnerController::class, 'loginPage'])->name('owner.login');
Route::get('admin/dashboard', [OwnerController::class, 'adminDashboard'])->name('dashboard');
Route::get('owner/dashboard', [OwnerController::class, 'ownerDashboard'])->name('owner.dashboard');
Route::get('owner/register', [OwnerController::class, 'registerPage'])->name('owner.register');
// Route::get('owner/properties',[PropertiesController::class,'getOwnerProperties'])->name('owner.properties');

// Route::get('owner/properties', [PropertyController::class, 'index'])->name('owner.properties');
Route::get('payment/{booking_id}', [PaymentController::class, 'payment'])->name('payment.create');
Route::post('store-payment', [PaymentController::class, 'createPayment'])->name('payment.store');
Route::get('properties', [PropertyController::class, 'index'])->name('properties');
// Route::get('edit-property/{id}', [PropertyController::class, 'edit'])->name('properties.edit');
Route::delete('delete-property/{id}', [PropertyController::class, 'delete'])->name('properties.delete');
Route::get('create/property', [PropertyController::class, 'create'])->name('properties.create');

Route::post('add-property', [PropertyController::class, 'saveProperty'])->name('property.save');
Route::post('add-roomsCount', [PropertyController::class, 'saveRoomsCount'])->name('roomsCount.save');
Route::post('property-amenities', [PropertyController::class, 'savePropertyAmenities'])->name('property.amenities');
// Route::get('add-amenities', [PropertyController::class, 'addAmnities'])->name('amenities.add');
Route::post('add-amenities', [AmenityController::class, 'saveAmenities'])->name('amenities.save');
Route::get('edit-amenities/{id}', [AmenityController::class, 'editAmenities'])->name('amenities.edit');
Route::get('amenities', [AmenityController::class, 'getAmenities'])->name('amenities');
Route::get('delete-amenities/{id}', [AmenityController::class, 'deleteAmenities'])->name('amenities.delete');
Route::post('property-images', [PropertyController::class, 'savePropertyImages'])->name('property.images');
Route::post('submit-application', [PropertyController::class, 'submitApplication'])->name('submit.application');
Route::get('currency', [CurrencyController::class, 'index'])->name('currency');
Route::get('find-property', [PropertiesController::class, 'findProperty'])->name('find.property');
Route::post('save-currency', [CurrencyController::class, 'save'])->name('currency.save');
Route::get('delete-currency/{id}', [CurrencyController::class, 'delete'])->name('currency.delete');
// Route::get('edit-currency/{id}', [CurrencyController::class, 'edit'])->name('currency.edit');

Route::get('login', [UserController::class, 'login'])->name('login');
Route::post('login', [UserController::class, 'authenticate'])->name('login.user');
Route::get('register', [UserController::class, 'register'])->name('register');
Route::post('register', [UserController::class, 'store'])->name('register.user');
Route::post('logout', [UserController::class, 'logout'])->name('logout');
Route::get('profile', [UserController::class, 'profile'])->name('profile');
Route::put('update-password', [UserController::class, 'updatePassword'])->name('update.password');
Route::put('update-profile', [UserController::class, 'updateProfile'])->name('profile.update');


Route::get('/json_data', function() {

    $jsonData = [
        "name" => "John Doe",
        "age" => 30,
        "isEmployed" => true,
        "skills" => ["Python", "Rust"],
        "address" => [
            "street" => "123 Main St",
            "city" => "San Francisco"
        ]
    ];

    $encodedJson = json_encode($jsonData);

    $decodedJson = json_decode($encodedJson, true); 

    echo "JSON Data:<br>";
    echo '<pre>';
    var_dump($jsonData);
    echo '</pre>';
    echo "<br>Encoded JSON Data:<br>";
    echo '<pre>';
    echo $encodedJson;
    echo '</pre>';
    echo "<br>Decoded JSON Data:<br>";
    echo '<pre>';
    var_dump($decodedJson);
    echo '</pre>';
});