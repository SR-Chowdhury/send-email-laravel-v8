<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SendEmailController;


Route::get('/sendemail', [SendEmailController::class, 'index']);
Route::post('/sendemail/send', [SendEmailController::class, 'send']);
