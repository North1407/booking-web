<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirebaseController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RideController;
use App\Http\Controllers\TicketController;

// Route hiển thị trang đăng nhập
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');

// Route xử lý đăng nhập
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Route hiển thị trang home sau khi đăng nhập thành công
Route::get('/home', [AuthController::class, 'home'])->name('home');
// Route xử lý đăng xuất
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/firebase/store', [FirebaseController::class, 'storeData']);
Route::get('/firebase/data', [FirebaseController::class, 'getData']);

Route::get('/rides', [RideController::class, 'index'])->name('rides.index');
Route::get('/rides/detail/{id}', [RideController::class, 'detailRide'])->name('rides.detail');

Route::match(['get', 'post'], '/rides/add', [RideController::class, 'addRide'])->name('rides.add');
Route::post('/rides/update-status/{id}', [RideController::class, 'editRide'])->name('rides.edit');
Route::delete('/rides/delete/{id}', [RideController::class, 'deleteRide'])->name('rides.delete');

Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
Route::get('/tickets/detail/{id}', [TicketController::class, 'detailTicket'])->name('tickets.detail');
Route::post('/tickets/add', [TicketController::class, 'addTicket'])->name('tickets.add');
Route::delete('/tickets/delete/{id}', [TicketController::class, 'deleteTicket'])->name('tickets.delete');
Route::get('/tickets/update-status/{id}', [TicketController::class, 'updateStatus'])->name('tickets.updateStatus');



