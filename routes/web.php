<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

// use App\Http\Controllers\StripePaymentController;

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

// Route::get('/', function () {
    // return view('welcome');
// });
// Route::get('/', [HomeController::class,'index'])->name('home');


//HomeController
Route::get('/', [HomeController::class, 'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('/redirect', [HomeController::class, 'redirect']);

//AdminController
    //category starts
Route::get('/view_category', [AdminController::class, 'view_category']);

Route::post('/add_category', [AdminController::class, 'add_category']);

Route::get('/delete_category/{id}', [AdminController::class, 'delete_category']);
    //category ends

    //productBrand starts
Route::get('/view-product-brand', [AdminController::class, 'viewProductBrand']);

Route::post('/add-product-brand', [AdminController::class, 'addProductBrand']);

Route::get('/delete-product-brand/{id}', [AdminController::class, 'deleteProductBrand']);
    //productBrand ends


    //productStore starts
Route::get('/view-product-store', [AdminController::class, 'viewProductStore']);

Route::post('/add-product-store', [AdminController::class, 'addProductStore']);

Route::get('/delete-product-store/{id}', [AdminController::class, 'deleteProductStore']);
    //productStore ends

    //product starts
Route::get('/view_product', [AdminController::class, 'view_product']);

Route::post('/add_product', [AdminController::class, 'add_product']);
        //view
Route::get('/show_product', [AdminController::class, 'show_product']);

        //action
Route::get('/delete_product/{id}', [AdminController::class, 'delete_product']);
        //view
Route::get('/update_product/{id}', [AdminController::class, 'update_product']);
        //action
Route::post('/update_product_confirm/{id}', [AdminController::class, 'update_product_confirm']);
    //product ends

    //order starts
Route::get('/order', [AdminController::class, 'order']);

Route::post('/set-delivery-status/{id}', [AdminController::class, 'setDeliveryStatus']);


Route::get('/print_pdf/{id}', [AdminController::class, 'print_pdf']);



// Route::get('/view_products', [AdminController::class, 'view_products']);
// Route::get('/view_product/{id}', [AdminController::class, 'view_product']);

    //product ends
//AdminController ends

















//HomeController starts

    //product
Route::get('/product_details/{id}', [HomeController::class, 'product_details']);

    //cart
Route::get('/show_cart', [HomeController::class, 'show_cart']);

Route::post('/add_cart/{id}', [HomeController::class, 'add_cart']);

Route::get('/remove_cart/{id}', [HomeController::class, 'remove_cart']);

Route::post('/modifyCartItemQuantity/{id}', [HomeController::class, 'modifyCartItemQuantity']);
    //cart


    //order
Route::get('/cash_order ', [HomeController::class, 'cash_order']);

    //for cart page
Route::get('/stripe/{totalPrice}', [HomeController::class, 'stripe']);



// Route::controller(StripePaymentController::class)->group(function(){
//     Route::get('stripe', 'stripe');
//     Route::post('stripe', 'stripePost')->name('stripe.post');
// });
Route::post('stripe/{totalPrice}', [HomeController::class, 'stripePost'])->name('stripe.post');

//HomeController ends


