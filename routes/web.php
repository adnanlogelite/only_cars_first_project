<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;
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
// Route::get('/', function(){
//     dd('okk');
// });
Route::middleware(['checklogin'])->group(function () {
    Route::get('/dashboard', [adminController::class, 'dashboard']);
    Route::get('/categories', [adminController::class, 'categories']);
    Route::get('/add-category/{id?}', [adminController::class, 'add_category']);
    Route::post('/category-added', [adminController::class, 'category_added']);
    Route::get('/delete-category/{id}', [adminController::class, 'delete_category']);
    Route::get('/add-listing/{id?}', [adminController::class, 'listing']);
    Route::get('/listing', [adminController::class, 'listings']);
    Route::post('/listing-added', [adminController::class, 'listing_added']);
    Route::get('/listing-deleted/{id}', [adminController::class, 'delete_listing']);
    Route::get('/admin-users', [adminController::class, 'users']);
    Route::get('/admin-enquiry', [adminController::class, 'enquiry']);
    Route::get('/read-enquiry/{id?}', [adminController::class, 'read_enquiry']);
    Route::get('/update-banner', [adminController::class, 'banner']);
    Route::get('/banner-list', [adminController::class, 'banner_list']);
    Route::post('/banner-uploaded', [adminController::class, 'banner_upload']);
    Route::delete('/banner-deleted', [adminController::class, 'delete_all']);
    Route::post('/banner-updated', [adminController::class, 'banner_status']);
    Route::post('/feature-list', [adminController::class, 'featured']);
    Route::get('/edit-user/{id?}', [adminController::class, 'edit_user']);
    Route::post('/user-edited', [adminController::class, 'user_edited']);
    Route::get('/delete-user/{id}', [adminController::class, 'udelete']);
    Route::get('/admin-faq', [adminController::class, 'admin_faq']);
    Route::post('/upload-faq', [adminController::class, 'upload_faq']);
    Route::get('/faq-form/{id?}', [adminController::class, 'faq_form']);
    Route::get('/delete-faq/{id}', [adminController::class, 'delete_faq']);
    Route::get('/admin-privacy', [adminController::class, 'admin_privacy']);
    Route::post('/upload-privacy', [adminController::class, 'upload_privacy']);
    Route::get('/admin-address', [adminController::class, 'address']);
    Route::post('/add-address', [adminController::class, 'add_address']);
    Route::get('/social-icon', [adminController::class, 'social']);
    Route::post('/upload-social-media', [adminController::class, 'social_media']);
    Route::get('/contact-queries', [adminController::class, 'contact_queries']);
    Route::get('/read-query/{id?}', [adminController::class, 'read_query']);
});
Route::middleware(['checkdashboard'])->group(function () {
    Route::get('/admin-register', [adminController::class, 'admin_register']);
    Route::post('/admin-register', [adminController::class, 'register']);
    Route::get('/admin-login', [adminController::class, 'admin_login']);
    Route::post('/admin-login', [adminController::class, 'login']);
});
Route::get('/admin-logout', [adminController::class, 'logout']);

// FrontEnd Routes 

Route::middleware(['ulogin'])->group(function () {
    Route::get('/my-enquiry', [UserController::class, 'shopping_cart']);
    Route::get('/enquire-now/{id}', [UserController::class, 'enquire']);
});
Route::middleware(['hassesion'])->group(function () {
    Route::any('/register', [UserController::class, 'register']);
    Route::any('/login', [UserController::class, 'login']);
});
Route::get('/home', [UserController::class, 'home']);
Route::get('/shop/{brands?}', [UserController::class, 'shop']);
Route::get('/product-detail/{id}', [UserController::class, 'product']);
Route::any('/contact', [UserController::class, 'contact']);
Route::get('/verify-token/{token}', [UserController::class, 'verify']);
Route::get('/logout', [UserController::class, 'user_logout']);
Route::any('/price-filter', [UserController::class, 'price_filter']);
Route::get('/cat-list', [UserController::class, 'categories']);
Route::get('/category/{id}', [UserController::class, 'category_product']);
Route::get('/cities', [UserController::class, 'cities']);
Route::get('/social', [UserController::class, 'social']);
Route::get('/city/{city}', [UserController::class, 'city']);
Route::get('/search', [UserController::class, 'search']);
Route::get('/search-list', [UserController::class, 'search_list']);
Route::post('/send-enquiry', [UserController::class, 'send_enquiry']);
Route::get('/top', [UserController::class, 'enq']);
Route::get('/faq', [UserController::class, 'faq']);
Route::get('/privacy-policy', [UserController::class, 'privacy']);
Route::get('/footer-address', [UserController::class, 'footer_address']);


// product controller routes