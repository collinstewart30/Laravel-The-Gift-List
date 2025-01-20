<?php

use App\Http\Controllers\MylistController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Models\Mylist;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//View the Create New List page if logged in
Route::get('/create-new-list', function () {
    return view('create-new-list');
})->middleware(['auth', 'verified'])->name('create-new-list');

//View the My Lists page if logged in
Route::get('/my-lists', function () {
    $lists = Mylist::all();
    return view('my-lists', ['lists' => $lists]);
})->middleware(['auth', 'verified'])->name('my-lists');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Create a new list form
Route::post('create-mylist', [MylistController::class, 'createMylist']);

require __DIR__.'/auth.php';
