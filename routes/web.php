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

Route::post('/medicines/showInfo','MedicineController@showInfo')->name('medicines.showInfo');
Route::get('/medicines/showHighPrice','MedicineController@showHighPrice')->name('medicines.showHighPrice');

Route::post('transaction/showDataAjax','TransactionController@showAjax')->name('transaction.showAjax');
Route::get('transaction/showAllData','TransactionController@showData')->name('transaction.showAllData');

Route::resource('category','CategoryController');
Route::resource('medicine','MedicineController');

Route::post('category/getEditForm','CategoryController@getEditForm')->name('category.getEditForm');
Route::post('category/getEditForm2','CategoryController@getEditForm2')->name('category.getEditForm2');
Route::post('category/saveData','CategoryController@saveData')->name('category.saveData');
Route::post('category/deleteData','CategoryController@deleteData')->name('category.deleteData');

Route::post('medicine/getEditFormMedic','MedicineController@getEditFormMedic')->name('medicine.getEditFormMedic');
Route::post('medicine/deleteData','MedicineController@deleteData')->name('medicine.deleteData');
Route::post('medicine/getEditFormMedic2','MedicineController@getEditFormMedic2')->name('medicine.getEditFormMedic2');
Route::post('medicine/saveData','MedicineController@saveData')->name('medicine.saveData');