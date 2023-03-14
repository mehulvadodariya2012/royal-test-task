<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard;
use App\Http\Middleware\AuthUser;
use App\Http\Middleware\IsLogin;

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
})->name('home')->middleware(IsLogin::class);

// login
Route::post('/login',[Controller::class,'login'])->name('login');
Route::get('/login', function () {
    return view('welcome');
})->middleware(IsLogin::class);

Route::middleware([AuthUser::class])->group(function () {

    // dashboard
    Route::get('/dashboard',[Dashboard::class,'index'])->name('dashboard.index');

    // author
    Route::get('/author/{id}',[Dashboard::class,'getAuthorBook'])->name('author_books');
    Route::get('/author/delete/{id}',[Dashboard::class,'deleteAuthor'])->name('author_delete');

    // book
    Route::get('/book/delete/{id}',[Dashboard::class,'deleteBook'])->name('book_delete');
    Route::get('/book/add',[Dashboard::class,'addBook'])->name('create.book');
    Route::post('/book/create',[Dashboard::class,'createBook'])->name('book.add');

    // logout
    Route::get('/logout',[Controller::class,'logout'])->name('logout');
    Route::get('/profile',[Controller::class,'profile'])->name('profile');

});





