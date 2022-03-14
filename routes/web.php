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
    return view('Layouts/Conquer');
});

Route::resource('medicine','MedicineController');

Route::get('/report/listmedicine/{id}','CategoryController@showlist')->name('reportShowMedicine');

// tugas
Route::get('show_category','CategoryController@showAllData')->name('reportShowCategory');
Route::get('show_medicine_nfp', 'MedicineController@showAllDataNFP')->name('reportShowAllDataNFP');
Route::get('show_medicine_nfc', 'MedicineController@showAllDataNFC')->name('reportShowAllDataNFC');
Route::get('show_count_category', 'MedicineController@countCategory')->name('reportCountCategory');
Route::get('show_category_no_medicines', 'CategoryController@showCategoryNoMedicines')->name('reportShowCategoryNoMedicines');
Route::get('show_average_category', 'CategoryController@averageCategoryHaveMedicines')->name('reportAverageCategoryHaveMedicines');
Route::get('show_category_have_one_medicine', 'CategoryController@showCategoryHaveOneMedicine')->name('reportShowCategoryHaveOneMedicine');
Route::get('show_medicine_have_one_form', 'MedicineController@haveOneForm')->name('reportHaveOneForm');
Route::get('show_medicine_category_maxprice', 'MedicineController@medicineHighestPrice')->name('reportmedicineHighestPrice');