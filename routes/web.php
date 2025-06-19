<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KatalogController;

Route::get('/katalog', [KatalogController::class, 'showForm'])->name('katalog.form');


Route::post('/hitung-diskon', [KatalogController::class, 'hitungDiskon'])->name('katalog.hitung');