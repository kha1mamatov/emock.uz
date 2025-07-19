<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;

Route::get('lang/{lang}', [LanguageController::class, 'switch'])->name('lang.switch');
