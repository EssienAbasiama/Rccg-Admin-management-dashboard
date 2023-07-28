<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\NewcomerController;
use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// Routes Without Authentication
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('/admin/register', [AdminController::class, 'registerAdmin'])->name('register');
Route::post('newcomers', [NewComerController::class, 'store'])->name('newcomers');
Route::post('emails/{id}', [NewComerController::class, 'sendSingleEmail']);
Route::post('sendbulk-email', [NewComerController::class, 'sendBulkEmail']);
Route::get('/newcomers/search/{email}', [NewComerController::class, 'search']);
Route::get('newcomers/{id}', [NewComerController::class, 'show']);
Route::post('newcomers/{id}', [NewComerController::class, 'update']);
Route::delete('newcomers/{id}', [NewComerController::class, 'destroy']);
// Logout route
Route::middleware('auth:sanctum')->post('/logout', [LogoutController::class, 'logout']);

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    // Your admin-protected routes go here
    Route::get('newcomers', [NewComerController::class, 'index']);
   
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('profile_pictures/{filename}', function ($filename) {
    $path = storage_path('/app/public/profile_pictures/' . $filename);
    // return($path);
    if (file_exists($path)) {
        return response()->file($path);
    } else {
        // abort(404);
        return "Failed to Load Images";
    }
})->where('filename', '.*');

Route::get('/hello', function () {
    return "Hello";
});
