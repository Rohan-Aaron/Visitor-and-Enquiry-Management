<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitorsController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\VisitorCategoryController;
use App\Http\Controllers\EnquiryController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/form', [FormController::class, 'showForm'])->name('form.show');
Route::post('/submit', [FormController::class, 'submitForm'])->name('form.submit');
Route::get('/visitors/result', function () {
    return view('visitors.form_result');
})->name('visitors.result');
Route::post('/',[EnquiryController::class,'submitform'])->name('enquiry.submit');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // This will handle all the basic CRUD actions for the 'visitor' resource
    Route::resource('visitors', VisitorsController::class);
    Route::resource('enquiry', EnquiryController::class);
    // Ensure that you have the correct route in your routes file
Route::get('/enquiry/{id}', [EnquiryController::class, 'show'])->name('enquiry.show');

    Route::get('/category/VisitorCategory', [VisitorCategoryController::class, 'index'])
     ->name('category.VisitorCategory');
     Route::resource('category', VisitorCategoryController::class);
});

require __DIR__.'/auth.php';
