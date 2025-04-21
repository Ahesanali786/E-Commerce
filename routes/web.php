<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AtributeController;
use App\Http\Controllers\AtributeValueController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Sub_CategoryController;
use App\Http\Controllers\UserAdminController;
use App\Http\Middleware\AuthChack;
use App\Http\Middleware\UserChack;
use App\Models\OrderDetails;
use Illuminate\Support\Facades\Route;


Route::view('test', 'test');


Route::middleware('AuthChack')->group(function () {

    Route::get('students/list', [StudentController::class, 'index'])->name('students.details');

    Route::get('student/form', [StudentController::class, 'create_student'])->name('students.form');
    Route::post('student/store', [StudentController::class, 'store_students'])->name('students.store');

    Route::get('students/edit/{id}', [StudentController::class, 'create_student'])->name('students.edit');
    Route::post('students/update/{id}', [StudentController::class, 'update'])->name('students.update');

    Route::delete('student/data/deleted/{id}', [StudentController::class, 'destroy'])->name('student.delet');

    Route::get('student/all/data/{id}', [StudentController::class, 'showData'])->name('students.data');


    // E-Commerce Route

    Route::get('all/products/list', [ProductController::class, 'All_Products'])->name('all.products');
    Route::get('add/product', [ProductController::class, 'CreateProduct'])->name('add.products');
    Route::post('get/sub/category', [ProductController::class, 'showSubCategorys'])->name('get.sub.category');
    Route::post('store/product', [ProductController::class, 'Store_Product'])->name('store.products');
    Route::get('edit/product/{id}', [ProductController::class, 'UpdateProducts'])->name('edit.product');
    Route::post('update/product/{id}', [ProductController::class, 'Update_Product'])->name('update.product');
    Route::post('get/subcategory', [ProductController::class, 'UpdateSubCategorys'])->name('get.subcategory');
    Route::get('product/delete/{id}', [ProductController::class, 'Destroye_Product'])->name('product.delete');


    Route::get('all/category/list', [CategoryController::class, 'All_Categorys'])->name('all.category');
    Route::get('add/category', [CategoryController::class, 'Create_Update_Category'])->name('add.category');
    Route::post('store/category', [CategoryController::class, 'Store_Category'])->name('store.category');
    Route::get('edit/category/{id}', [CategoryController::class, 'Create_Update_Category'])->name('edit.category');
    Route::post('update/category/{id}', [CategoryController::class, 'Update_Category'])->name('update.category');
    Route::get('category/delete/{id}', [CategoryController::class, 'Destroye_Category'])->name('delete.category');




    Route::get('all/sub/category/list', [Sub_CategoryController::class, 'All_SubCategorys'])->name('all.sub.category');
    Route::get('add/sub/category', [Sub_CategoryController::class, 'CreateSubCategory'])->name('add.sub.category');
    Route::post('store/sub/category', [Sub_CategoryController::class, 'Store_SubCategory'])->name('store.sub.category');
    Route::get('edit/sub/category/{id}', [Sub_CategoryController::class, 'UpdateSubCategory'])->name('edit.sub.category');
    Route::post('update/sub/category/{id}', [Sub_CategoryController::class, 'Update_SubCategory'])->name('update.sub.category');
    Route::get('sub/category/delete/{id}', [Sub_CategoryController::class, 'DestroyeSubCategory'])->name('delete.sub.category');

    // Veriant Route

    Route::prefix('veriant')->group(function () {
        route::get('list', [AtributeController::class, 'showallveriants'])->name('veriants.list');
        Route::get('/', [AtributeController::class, 'createvariants'])->name('create.new.veriant');
        Route::post('add', [AtributeController::class, 'storeveriants'])->name('store.veriants');
        Route::get('/edit/{id}', [AtributeController::class, 'createvariants'])->name('edit.veriant');
        Route::post('update/{id}', [AtributeController::class, 'updateveriants'])->name('update.veriants');
        Route::get('delete/{id}', [AtributeController::class, 'deleteveriants'])->name('delete.veriants');
    });

    Route::prefix('veriants/value')->group(function () {
        Route::get('list', [AtributeValueController::class, 'showallvalue'])->name('veriants.value.list');
        Route::get('add', [AtributeValueController::class, 'createveriantsvalue'])->name('create.veriants.velua');
        Route::post('get/varinats', [AtributeValueController::class, 'getvariants'])->name('get.variants');
        Route::post('update/varinats', [AtributeValueController::class, 'updatevariants'])->name('update.variants');
        Route::post('store', [AtributeValueController::class, 'storeveriantsvalue'])->name('store.veriants.values');
        Route::get('edit/{id}', [AtributeValueController::class, 'editveriantsvalue'])->name('edit.veriants.velua');
        Route::post('update/{id}', [AtributeValueController::class, 'updateveriantsvalue'])->name('update.veriants.values');
        Route::get('deleted/{id}', [AtributeValueController::class, 'deleteveriantsvalue'])->name('delete.veriants.value');
    });

    Route::prefix('order')->group(function () {
        Route::get('product', [OrderController::class, 'orderDetails'])->name('order.products');
        Route::get('product/confirmation/{id}', [OrderDetailsController::class, 'showOrderDetails'])->name('details.order.products');
        Route::post('products', [OrderController::class, 'placeorder'])->name('place.order');
    });

    Route::prefix('user/account')->group(function () {

        Route::get('orders', [OrderDetailsController::class, 'shwouserOrders'])->name('user.dashboard.orders.list');
        Route::get('/', [OrderDetailsController::class, 'showUserAccounts'])->name('user.accounts');
        Route::get('/address', [AddressController::class, 'showAddress'])->name('user.accounts.address');
        Route::get('/add-newaddress', [AddressController::class, 'addNewAddress'])->name('add.new.address');
        Route::post('/store/address', [AddressController::class, 'storeAddress'])->name('store.address');
        Route::get('/edit-newaddress/{id}', [AddressController::class, 'editAddress'])->name('edit.address');
        Route::post('/update/address/{id}', [AddressController::class, 'updateAddress'])->name('update.address');
        Route::get('delete/address/{id}',[AddressController::class,'deleteAddress'])->name('delete.address');

        //chart analytics Routes
        //default route
        Route::get('dashboard', [UserAdminController::class, 'showData'])->name('user.dashboard');
        Route::get('last-month/data',[UserAdminController::class,'getLastMonthOrder'])->name('last.month.data');
        Route::get('last-week/data',[UserAdminController::class,'getLastWeekOrders'])->name('last.week.data');
        Route::get('last-year/data',[UserAdminController::class,'getLastYearOrder'])->name('last.year.data');

        /**
         * download data with exel formate
         */

         Route::post('orders/list/download',[UserAdminController::class,'dawloadDataExalFormate'])->name('order.download.excel');
         Route::get('orders/list/download',[UserAdminController::class,'multipleData'])->name('multi.order.download.excel');

         /**
          * Import Data With Excel Sheet
          */

        Route::post('import/orders',[UserAdminController::class,'importDataWithExcel'])->name('import.data');
    });
});

// Website Routes

Route::get('/', [ShopController::class, 'index'])->name('home.page');
Route::get('shop/products', [ShopController::class, 'showCategories'])->name('shop.prodcuts');
Route::get('products/details/{id}', [ShopController::class, 'productDetails'])->name('prodcuts.details');
Route::get('product/variants/details/{id}', [ShopController::class, 'getvariantsproducts'])->name('prodcuts.variants.details');
Route::get('about', [ShopController::class, 'about'])->name('about.page');
Route::get('selected/products/{id}', [ProductController::class, 'CategoryReletedProducts'])->name('selected.products');



// cart route

Route::get('products/cart', [CartsController::class, 'cartDetails'])->name('product.cart');
Route::post('add/cart', [CartsController::class, 'addToCart'])->name('add.cart');
Route::post('update/cart/{id}', [CartsController::class, 'updateToCart'])->name('update.cart');
// Route::post('/cart/update-all', [CartsController::class, 'updateAllCart'])->name('cart.updateAll');
Route::post('cart/products/update/', [CartsController::class, 'updateAllCart'])->name('cart.update.qty');
Route::post('romove/product/{id}', [CartsController::class, 'DeleteCartProduct'])->name('remove.cart');
Route::get('product/order', [CartsController::class, 'order'])->name('product.order');
Route::get('product/order/confirmation', [CartsController::class, 'confirmationOrder'])->name('product.order.confirmation');
Route::post('/cart/update-all', [CartsController::class, 'updateAll'])->name('cart.updateAll');



// Authentication Routes
Route::middleware(UserChack::class)->group(function () {
    Route::get('register/user', [AuthController::class, 'register'])->name('register');
    Route::post('user/registered', [AuthController::class, 'addUser'])->name('user.register');

    Route::view('/login', 'Auth.login');
    Route::get('login/user', [AuthController::class, 'login'])->name('login');
    Route::post('user/logedin', [AuthController::class, 'chack_auth'])->name('user.chackUser');
});

Route::get('user/logout', [AuthController::class, 'logout'])->name('user.logout');



// Route::get('order', function () {
//     $users = OrderDetails::query()->paginate(5);

//     return view('test', [
//         'users' => $users,
//     ]);
// });
