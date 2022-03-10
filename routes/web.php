<?php

use Illuminate\Support\Facades\Route;

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

Route::resource('medicine','MedicineController');

Route::get('/report/listmedicine/{id}','CategoryController@showlist')->name('reportShowMedicine');

// tugas
Route::resource('show_category','CategoryController');
Route::resource('show_medicine_nfp', 'MedicineController');
Route::resource('show_medicine_nfc', 'MedicineController');
Route::resource('show_count_category', 'MedicineController');
Route::resource('show_category_no_medicines', 'CategoryController');
Route::resource('show_average_category', 'CategoryController');
Route::resource('show_category_have_one_medicine', 'CategoryController');
Route::resource('show_medicine_have_one_form', 'MedicineController');
Route::resource('show_medicine_category_maxprice', 'MedicineController');