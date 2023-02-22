<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactUsInfoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RegisterUserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DropdownController;

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

Route::get('/welcome', function () {
    return view('welcome');
})->name('index');

Auth::routes();

//:: All users access.
Route::get('/shop/welcome', [ProductController::class, 'welcome'])->name('shop.welcome');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/products/get-mobile-phones', [ProductController::class, 'phones']);
Route::get('/products/get-accessories', [ProductController::class, 'accessories']);
Route::get('/info/get-contact-us', [ContactUsInfoController::class, 'info'])->name('contact.us');

//:: Utils.
Route::get('/fetch-add-model-options', [DropdownController::class, 'fetchModels'])->name('models.list');
Route::get('/products/get-mobile-phones/detail/{id}', [ProductController::class, 'mobilePhoneDetail']);
Route::get('/products/get-accessories/detail/{id}', [ProductController::class, 'accessoryDetail']);
Route::get('/products/get-mobile-phones/search/{keyword}', [ProductController::class, 'searchPhones']);
Route::get('/products/get-accessories/search/{keyword}', [ProductController::class, 'searchAccessories']);

//:: Administrator access.
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/', [DashboardController::class, 'info'])->name('dashboard');
    Route::get('/dashboard',[DashboardController::class,'info'])->name('dashboard');
    Route::get('/products/get-products-list/add/{category_id}', [ProductController::class, 'add']);
    Route::post('/products/get-products-list/add', [ProductController::class, 'insert']);
    Route::post('/products/get-products-list/update', [ProductController::class, 'update']);
    Route::get('/users/get-user-list', [RegisterUserController::class, 'list'])->name('users.list');
    Route::get('/users/get-user-list/admin/filter/{filtered_role}', [RegisterUserController::class, 'filterUser']);
    Route::get('/sold-list/get-sold-list/admin', [ProductController::class, 'soldListAdmin'])->name('sold.list');
    Route::get('/sold-list/get-sold-list/admin/filter/{filtered_status}', [ProductController::class, 'filterSoldListAdminByStatus']);
    Route::get('/products/get-mobile-phones/admin/edit/{productId}', [ProductController::class, 'edit']);
    Route::get('/products/get-accessories/admin/edit/{productId}', [ProductController::class, 'edit']);
    Route::get('/sold-list/get-sold-list/admin/{invoice_no}', [ProductController::class, 'check']);
    Route::post('/products/check/status/update', [ProductController::class, 'updateStatus']);
    Route::get('/products/get-mobile-phones/admin', [ProductController::class, 'phonesList'])->name('admin.phone');
    Route::get('/products/get-accessories/admin', [ProductController::class, 'accessoriesList'])->name('admin.accessory');
    Route::post('/products/delete/phone/{id}', [ProductController::class, 'deletePhone'])->name('phone.delete');
    Route::post('/products/delete/accessory/{id}', [ProductController::class, 'deleteAccessory'])->name('accessory.delete');
    Route::get('/products/get-mobile-phones/admin/filter/{brand_id}/{model_id}', [ProductController::class, 'filterPhonesAdmin']);
    Route::get('/products/get-accessories/admin/filter/{brand_id}/{model_id}', [ProductController::class, 'filterAccessoriesAdmin']);
});

//:: User access.
Route::middleware(['auth', 'isUser'])->group(function () {
    Route::get('/info/get-my-cart', [ProductController::class, 'showCartList']);
    Route::get('/sold-list/get-sold-list/user', [ProductController::class, 'purchasedHistory']);
    Route::post('/products/phones/add-to-cart', [ProductController::class, 'addPhoneToCart']);
    Route::post('/products/accessories/add-to-cart', [ProductController::class, 'addAccessoriesToCart']);
    Route::get('/products/cart/delete/{id}', [ProductController::class, 'removeCartItem']);
    Route::get('/products/cart/purchase/{delivery_fee}', [ProductController::class, 'purchase']);
    Route::post('/products/cart/purchase/save', [ProductController::class, 'save']);
    Route::get('/products/done', [ProductController::class, 'done']);
    Route::get('/sold-list/get-sold-list/user/detail/{invoice_no}', [ProductController::class, 'showUserProductDetail']);
});
