<?php

use App\Models\Mylist;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MylistController;
use App\Http\Controllers\ProfileController;

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
    $lists = [];
    if (auth()->check()) {
        $lists = auth()->user()->usersCoolLists()->latest()->get();
    }
    return view('my-lists', ['lists' => $lists]);
})->middleware(['auth', 'verified'])->name('my-lists');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// List Related Routes
Route::post('create-mylist', [MylistController::class, 'createMylist']);
Route::get('/edit-list/{list}', [MylistController::class, 'showEditScreen']);
Route::put('/edit-list/{list}', [MylistController::class, 'updateList']);
Route::delete('/delete-list/{list}', [MylistController::class, 'deleteList']);

//Item Related Routes
Route::post('add-new-item/{list}', [MylistController::class, 'addItemToList']);

require __DIR__ . '/auth.php';
