<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CondidateController;
use App\Http\Controllers\SortingCondidateController;
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




Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/', [CondidateController::class, 'list']);

    Route::get('/new', function () {
        return view('add-condidate');
    })->name("add-condidate");
    Route::get('/sorting', [SortingCondidateController::class, 'store'])->name("sorting-condidate");
    Route::get('/list-condidate', [CondidateController::class, 'list'])->name("list-condidate");
    Route::post('/list-condidate', [CondidateController::class, 'list'])->name("list-condidate");
    Route::get('/view/{condidate_id}', [CondidateController::class, 'view'])->name("view-condidate");
    Route::post('/edit/{condidate_id}', [CondidateController::class, 'edit'])->name("edit-condidate");
    Route::get('/sorted', [SortingCondidateController::class, 'view'])->name("sorted-condidate-view");
    Route::get('/sorted-report/{sorting_condidate_id}', [SortingCondidateController::class, 'reportCondidateSorting'])->name("sorted-condidate-report");
    Route::get('/pdf-sorted-report/{sorting_condidate_id}', [SortingCondidateController::class, 'pdfReportCondidateSorting'])->name("pdf-sorted-condidate-report");

    #Route::post('/store','CondidateController@store')->name("store-condidate");
    Route::post('/store', [CondidateController::class, 'store'])->name("store-condidate");
});



require __DIR__ . '/auth.php';
