<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');






Route::group(['prefix' => 'admin', 'middleware'=>'auth'], function (){
    Route::get('/users','UserController@index');
    Route::get('/users/{id}/edit','UserController@edit');
    Route::post('/users/{id}/add-role','UserController@addRole');
    
    Route::get('/managers','ManagerController@index');
    Route::get('/staffs','StaffController@index');

    Route::get('/categories','Admin\CategoryController@index');
    Route::get('/add-category','Admin\CategoryController@add');
    Route::post('/insert-category','Admin\CategoryController@insert');
    Route::get('/categories/{id}/edit',[CategoryController::class,'edit']);
    Route::put('/update-category/{id}',[CategoryController::class,'update']);
    Route::get('/categories/{id}/delete',[CategoryController::class,'destroy']);

    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/add-product', [ProductController::class, 'add']);
    Route::post('/insert-product', [ProductController::class, 'insert']);
    Route::get('/products/{id}/edit', [ProductController::class, 'edit']);
    Route::put('/update-product/{id}', [ProductController::class, 'update']);
    Route::get('/products/{id}/delete', [ProductController::class, 'destroy']);
});
