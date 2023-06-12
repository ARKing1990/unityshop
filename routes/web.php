<?php
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;


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
//Landing
Route::get('/', [LandingController::class, 'index'])->name('landing');

//Auth
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::get('/product/view/{id}', [ProductController::class, 'view'])->name('product.view');

Route::middleware('auth')->group(function(){
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //Product
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');

    //Admin
    Route::middleware('role:Admin')->group(function(){
        //Role
        Route::get('/role', [RoleController::class, 'index'])->name('role.index');
        Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
        Route::post('/role', [RoleController::class, 'store'])->name('role.store');
        Route::get('/role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
        Route::put('/role/{id}', [RoleController::class, 'update'])->name('role.update');
        Route::delete('/role/{id}', [RoleController::class, 'destroy'])->name('role.destroy');

        //User
        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/user', [UserController::class, 'store'])->name('user.store');
        Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

        //Brand
        Route::get('/brand', [BrandController::class, 'index'])->name('brand.index');
        Route::get('/brand/create', [BrandController::class, 'create'])->name('brand.create');
        Route::get('/brand/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
        Route::post('/brand', [BrandController::class, 'store'])->name('brand.store');
        Route::put('/brand/{id}', [BrandController::class, 'update'])->name('brand.update');
        Route::delete('/brand/{id}', [BrandController::class, 'destroy'])->name('brand.destroy');

        //Category
        Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

        //Product
        Route::get('/product/show', [ProductController::class, 'show'])->name('product.show');
        Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::post('/product/{id}/accept', [ProductController::class, 'accept'])->name('product.accept');
        Route::post('/product/{id}/reject', [ProductController::class, 'reject'])->name('product.reject');
        Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

        //Slider
        Route::get('/slider/show', [SliderController::class, 'show'])->name('slider.show');
        Route::get('/slider/edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
        Route::put('/slider/{id}', [SliderController::class, 'update'])->name('slider.update');
        Route::post('slider/{id}/accept', [SliderController::class, 'accept'])->name('slider.accept');
        Route::post('slider/{id}/reject', [SliderController::class, 'reject'])->name('slider.reject');
        Route::delete('/slider/{id}', [SliderController::class, 'destroy'])->name('slider.destroy');
    });

    //Admin, Staff
    Route::middleware('role:Admin|Staff')->group(function(){
        //Product
        Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/product', [ProductController::class, 'store'])->name('product.store');
        // Slider
        Route::get('/slider', [SliderController::class, 'index'])->name('slider.index');
        Route::get('/slider/create', [SliderController::class, 'create'])->name('slider.create');
        Route::post('/slider', [SliderController::class, 'store'])->name('slider.store');
    });

});

