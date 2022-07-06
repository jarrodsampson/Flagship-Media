<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MovieController;

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

Route::get('/greeting', function () {
    return [
        'title' => 'Hello World'
    ];
});

Route::redirect('/here', '/');

// change status if needed
// Route::redirect('/here', '/there', 301);
// permanent redirect
// Route::permanentRedirect('/here', '/there');


// basic view
Route::view('/events', 'events');
// passing in with data
Route::view('/events', 'events', ['name' => 'Ty']);
// passing in with param
Route::get('/user/{id}', function ($id) {
    return 'User '.$id;
});
// named route
Route::get('/user/profile', function ($id) {
    return 'User '.$id;
})->name('profile');

// optional param
Route::get('/userData/{name?}', function ($name = null) {
    return $name;
});

// multiple routes to the same controller
Route::controller(OrdersController::class)->group(function () {
    Route::get('/orders/{id}', 'show');
    Route::post('/orders', 'store');
});

// resource that supports all methods
Route::resource('movies', MovieController::class);

// if no other matching routes
Route::fallback(function () {
    return 'Nothing Like that found...';
});