<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KondisiController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('inventaris', InventarisController::class);
Route::resource('kategori', KategoriController::class);
Route::resource('kondisi', KondisiController::class);
