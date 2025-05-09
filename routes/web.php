<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', App\Livewire\Posts\Index::class)->name('posts.index');