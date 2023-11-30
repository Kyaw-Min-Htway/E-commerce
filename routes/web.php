<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

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

Route::middleware(['auth'])->group(function () {
    // admin
    // category
    Route::group(['prefix'=>'category','middleware' => 'admin_auth'],function(){
        Route::get('list',[CategoryController::class,'list'])->name('category#list');
        Route::get('create/page', [CategoryController::class,'createPage'])->name('category#createPage');
        Route::post('create',[CategoryController::class,'create'])->name('category#create');
        Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
        Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
        Route::post('update',[CategoryController::class,'update'])->name('category#update');
    });

    Route::group(['prefix' => 'products', 'middleware' => 'admin_auth'], function(){
        Route::get('list',[ProductController::class,'list'])->name('product#list');
        Route::get('create',[ProductController::class,'create'])->name('product#create');
        Route::post('create',[ProductController::class,'createPizza'])->name('product#createPizza');
        Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
        Route::get('details/{id}',[ProductController::class,'details'])->name('product#details');
        Route::get('edit/{id}',[ProductController::class,'edit'])->name('product#edit');
        Route::post('update',[ProductController::class,'update'])->name('product#update');
    });

    Route::group(['prefix' => 'admin'],function(){
        Route::get('password/change',[AdminController::class,"changePasswordPage"])->name('admin#changePasswordPage');
        Route::post('password/change',[AdminController::class,"changePassword"])->name('admin#changePassword');
        Route::get('detail',[AdminController::class,'changeDetail'])->name('admin#detail');
        Route::get('edit/profile',[AdminController::class,'editProfile'])->name('admin#editProfile');
        Route::post('update/{id}',[AdminController::class,'update'])->name('admin#update');
        Route::get('list',[AdminController::class,'list'])->name('admin#list');
        Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
        Route::get('role/change/{id}',[AdminController::class,'roleChange'])->name('role#change');
        Route::post('changed/{id}',[AdminController::class,'changed'])->name('changed');
        Route::get('message',[AdminController::class,'message'])->name('admin#message');
    });
    // user
    // home
    Route::group(['prefix' => 'user','middleware' => 'user_auth'],function(){
        Route::get('home',[UserController::class,'home'])->name('user#home');
        Route::get('/home/{id}',[UserController::class,'filter'])->name('user#filter');
        Route::get('pizza/details/{id}',[UserController::class,'pizzaDetails'])->name('pizza#details');
    });
    // dashboard
    Route::get('dashboard',[AuthController::class,'dashboard',])->name('dashboard');
});


Route::middleware('admin_auth')->group(function(){
    // login , register
Route::redirect('/','loginPage');
Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginpage');
Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerpage');

});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['prefix' => 'user'],function(){
    Route::get('changePassword',[UserController::class,'changePassword'])->name('user#changePassword');
    Route::get('details',[UserController::class,'details'])->name('user#details');
    Route::post('update/details/{id}',[UserController::class,'update'])->name('user#update');
    Route::get('user/cart',[UserController::class,'cartList'])->name('user#cart');
    Route::get('/history',[UserController::class,'history'])->name('user#history');
    Route::get('contact',[UserController::class,'contact'])->name('user#contactus');
    Route::get('aboutus',[UserController::class,'aboutus'])->name('user#aboutus');
});

Route::prefix('ajax')->group(function(){
    Route::get('pizza/list',[AjaxController::class,'pizzaList'])->name('ajax#pizzaList');
    Route::get('pizza/list/count',[AjaxController::class,'cart'])->name('ajax#cart');
    Route::get('/pizzas/order',[AjaxController::class,'order'])->name('ajax#order');
    Route::get('/product/remove',[AjaxController::class,'productRemove']);
    Route::get('pizza/view/count',[AjaxController::class,'viewCount']);
    Route::get('/message/list',[AjaxController::class,'message']);
});

Route::prefix('order')->group(function(){
    Route::get('list',[OrderController::class,'orderList'])->name('order#list');
    Route::get('status',[OrderController::class,'orderStatus'])->name('order#status');
    Route::get('change',[OrderController::class,'statusChange']);
    Route::get('list/info/{orderCode}',[OrderController::class,'listInfo'])->name('list#info');
});
