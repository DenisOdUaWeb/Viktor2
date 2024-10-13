<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\ContactFormController;

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

Route::get('contacts', [ContactFormController::class, 'create']);
Route::post('contacts', [ContactFormController::class, 'store']);

Route::view('about', 'about')->middleware('test');

//user_profile (frendly url testing):::
Route::get('users', [UsersController::class, 'index'])->name('users.index');
Route::get('users/{user}', [UsersController::class, 'show'])->name('users.show');

Route::get('customers', [CustomersController::class, 'index'])->name('customers.index');
Route::get('customers/create', [CustomersController::class, 'create'])->name('customers.create');
Route::post('customers', [CustomersController::class, 'store'])->name('customers.store');

// SLUG it for frendly URLs
Route::get('customers/{customer}-{slug}', [CustomersController::class, 'show'])->middleware('can:view,customer')->name('customers.show');
Route::get('customers/{customer}/edit', [CustomersController::class, 'edit'])->name('customers.edit');
Route::patch('customers/{customer}', [CustomersController::class, 'update'])->name('customers.update');
Route::delete('customers/{customer}', [CustomersController::class, 'destroy'])->name('customers.destroy');
//refactoring laravel v 10 +

//Route::resource same as all at the top here 
//Route::resource('customers', CustomersController::class)->shallow();

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::post('/images', [UploadsController::class, 'store'])->name('store');
// THIS IS AN API CALL 
// MUST BE AT API.PHP ROUTES FILE api.php 
