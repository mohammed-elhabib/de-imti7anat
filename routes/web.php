<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CondidateController;
use App\Http\Controllers\SortingCondidateController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/new', function () {
    return view('add-condidate');
})->name("add-condidate");
Route::get('/sorting', [SortingCondidateController::class, 'store'])->name("sorting-condidate");
Route::get('/list-condidate', [CondidateController::class, 'list'])->name("list-condidate");
Route::get('/view/{condidate_id}',[CondidateController::class, 'view'])->name("view-condidate");
Route::post('/edit/{condidate_id}',[CondidateController::class, 'edit'])->name("edit-condidate");
Route::get('/sorted', [SortingCondidateController::class, 'view'])->name("sorted-condidate-view");
Route::get('/sorted/report/{sorting_condidate_id}', [SortingCondidateController::class, 'reportCondidateSorting'])->name("sorted-condidate-report");

#Route::post('/store','CondidateController@store')->name("store-condidate");
Route::post('/store', [CondidateController::class, 'store'])->name("store-condidate");
