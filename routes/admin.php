<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\Admin\LinkController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MainCategoryController;
use App\Http\Controllers\Admin\SubCategoryController;


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function (){
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->middleware('role:admin')->name('dashboard');

    /** Profile */
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    /** link url */
    Route::get('link', [LinkController::class, 'index'])->name('link');
    Route::get('link/get', [LinkController::class, 'getLink'])->name('get.link');
    Route::post('link/create', [LinkController::class, 'linkCreate'])->name('link.create');
    Route::get('link/edit/{id}', [LinkController::class, 'linkEdit'])->name('link.edit');
    Route::put('link/update/{id}', [LinkController::class, 'linkUpdate'])->name('link.update');
    Route::delete('link/destroy/{id}', [LinkController::class, 'linkDestroy'])->name('link.destroy');

    /** User setting router  */
    Route::resource('user', UserController::class);

    /** slider */
    Route::resource('slider', SliderController::class);

    /** blog */
    Route::resource('blog', BlogController::class);

    /** Main Categories */
    Route::resource('main/category', MainCategoryController::class);

    /** Sub Categories */
    // Route::resource('sub/category', SubCategoryController::class);

    /** log  history  */
    Route::get('history',[HistoryController::class, 'index'])->name('history');
    Route::post('url/copy',[HistoryController::class, 'copyUrl'])->name('copy.url');

});

