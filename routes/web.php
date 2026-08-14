<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PpdbController;

// 1. Beranda
Route::get('/', [PageController::class, 'index'])->name('home');

// 2. Galeri Foto & Pengumuman
Route::get('/galeri', [PageController::class, 'gallery'])->name('gallery');
Route::get('/pengumuman', [PageController::class, 'pengumuman'])->name('pengumuman');

// 3. Blog & Berita
Route::get('/blog', [PageController::class, 'blog'])->name('blog.index');
Route::get('/blog/{slug}', [PageController::class, 'blogDetail'])->name('blog.show');

// 4. Submenu Kesiswaan
Route::get('/kesiswaan/prestasi', [PageController::class, 'kesiswaanPrestasi'])->name('kesiswaan.prestasi');
Route::get('/kesiswaan/agenda', [PageController::class, 'kesiswaanAgenda'])->name('kesiswaan.agenda');
Route::get('/kesiswaan/guru', [PageController::class, 'kesiswaanGuru'])->name('kesiswaan.guru');

// 5. PPDB Online
Route::get('/ppdb', [PpdbController::class, 'index'])->name('ppdb.index');
Route::post('/ppdb', [PpdbController::class, 'store'])->name('ppdb.store');
