<?php

use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('send-email', function () {
    $mailData = [
        "name" => "Test NAME",
        "dob" => "test out"
    ];
    Mail::to("no-reply@gmail.com")->send(new TestEmail($mailData));
    dd("Mail Sent");
});
